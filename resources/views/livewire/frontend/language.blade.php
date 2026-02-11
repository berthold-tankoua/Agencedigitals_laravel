<div>
@if($language == 'french')       
    <li><button wire:click="English"> English</button></li>
 @else
    <li><button wire:click="French"> French</button></li>
@endif 
</div>
