<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jobs\ChatMailNotif;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ChatMessage;
use App\Services\ChatService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    protected $chatService;

    public function __construct(ChatService $chatService){
        $this->chatService = $chatService;
    }

    public function SendMessage(Request $request){

        $request->validate([
            'msg' => 'required'
        ],[
           'msg.required'=>'Saisir un message',
        ]);

        ChatMessage::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request->recevier_id,
            'link' => $request->product_link,
            'msg' => $request->msg,
            'created_at' => Carbon::now(),
        ]);

        $receiver= User::findOrfail($request->recevier_id);
        // Dispatch du Job pour l’envoi d’e-mail
        $data = array();
        $data['sender_name'] = Auth::user()->name;
        $data['email'] = $receiver->email;
        $data['msg'] = $request->msg;
        $data['link'] = $request->link;
        dispatch(new ChatMailNotif($data));

        // A surveiller
        $authId = auth()->id();
        ChatMessage::where('sender_id', $request->recevier_id)->where('receiver_id', $authId)
        ->where('is_read', 0)->update(['is_read' => 1]);

        return response()->json(['message' => 'Message envoye avec Succes']);

    } // End Method

    public function GetAllUsers() {
        $authId = auth()->id();

        // Récupérer les utilisateurs avec qui on a discuté
        $chats = ChatMessage::where('sender_id', $authId)
                    ->orWhere('receiver_id', $authId)
                    ->orderBy('id', 'DESC')
                    ->get();

        $users = $chats->flatMap(function ($chat) use ($authId) {
            return $chat->sender_id === $authId
                ? [$chat->receiver]
                : [$chat->sender];
        })->unique('id');

        // Ajout du statut, formatage et compteur de messages non lus
        $formattedUsers = $users->map(function ($user) use ($authId) {
            // Compter les messages non lus envoyés par $user à l'utilisateur connecté
            $unreadCount = ChatMessage::where('sender_id', $user->id)
                ->where('receiver_id', $authId)
                ->where('is_read', 0)
                ->count();

            return [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'last_seen' => $user->last_seen ? $user->last_seen->diffForHumans() : null,
                'is_online' => $user->isOnline(),
                'unread_count' => $unreadCount, // ✅ Ajout du compteur
            ];
        });

        return $formattedUsers;
    }


    public function UserMsgById(Request $request, $userId)
    {
        $authId = auth()->id();
        $lastId = (int) $request->query('last_id', 0);

        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $is_online = $user->isOnline();

        // 🔹 Récupération des messages
        $messagesQuery = ChatMessage::where(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $authId)
                ->where('receiver_id', $userId);
            })
            ->orWhere(function ($q) use ($authId, $userId) {
                $q->where('sender_id', $userId)
                ->where('receiver_id', $authId);
            })
            ->with('user')
            ->orderBy('id', 'asc');

        // 🔹 Si last_id > 0 → on récupère uniquement les nouveaux messages
        if ($lastId > 0) {
            $messagesQuery->where('id', '>', $lastId);
        }

        $messages = $messagesQuery->get();

        // 🔹 Compteur des messages non lus (sans mise à jour)
        $unreadCount = ChatMessage::where('sender_id', $userId)
            ->where('receiver_id', $authId)
            ->where('is_read', 0)
            ->count();

        return response()->json([
            'user' => $user,
            'messages' => $messages,
            'is_online' => $is_online,
            'unread_count' => $unreadCount,
        ]);
    }

    public function UserMsgByIdV2($userId){

        $user = User::find($userId);
        $is_online = $user->isOnline();
        if ($user) {
            // ✅ Mettre à jour les messages non lus pour les marquer comme lus
            $authId = auth()->id();
           $messages = ChatMessage::where(function($q) use ($userId){
                $q->where('sender_id',auth()->id());
                $q->where('receiver_id',$userId);
                })->orWhere(function($q) use ($userId){
                $q->where('sender_id',$userId);
                $q->where('receiver_id',auth()->id());
                })->with('user')->get();

                // Nouveau compteur (devrait être 0)
                $unreadCount = ChatMessage::where('sender_id', $userId)
                    ->where('receiver_id', $authId)
                    ->where('is_read', 0)
                    ->count();

                return response()->json([
                'user' => $user,
                'messages' => $messages,
                'is_online' => $is_online,
                'unread_count'  => $unreadCount,
            ]);
        }else {
            abort(404);
        }

    }// End Method
}
