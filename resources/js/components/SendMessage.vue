<template>
<div>
    <form  @submit.prevent="sendMsg()">
     <div  class="contact-form">
        <div class="ip-group">
            <textarea name="msg" v-model="form.msg" rows="4" tabindex="4" placeholder="Envoyer un Message" aria-required="true"></textarea>
            <span class="text-success" v-if="succMessage.message" >{{ succMessage.message }}</span>
            <span class="text-danger" v-if="errors.msg" >{{ errors.msg[0] }}</span>
        </div>

        <button  type="submit" class="tf-btn btn-view primary hover-btn-view w-100">Envoyer le message <span class="icon icon-arrow-right2"></span></button>
     </div>
    </form>
</div>
</template>
<script>
export default {
    props:['recevierid','productid'],
    data(){
        return{
            form: {
             msg:"",
             recevier_id : this.recevierid,
             product_link : this.productid,
            },
            errors: {},
            succMessage: {},
        }
    },

    methods:{
        sendMsg(){
            axios.post('/send-message',this.form)
                .then((res) => {
                this.form.msg = "";
                this.succMessage = res.data;
                console.log(res.data);
                }).catch((err) => {
                this.errors = err.response.data.errors;
            })
        },

    }
}
</script>
