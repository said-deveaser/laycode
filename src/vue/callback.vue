<template>
    <div class="modal-wrapper">
        <modalMessage v-if="successModal" :message="modalMessage[0]" :color="modalMessage[1]" :sign="modalMessage[2]"></modalMessage>
        <div v-if="modalLoader" class="modal-wrapper__loader"></div>
        <section v-if="!sendedEmail" id="online-registration" class="modal-section" style="display: block">
            <div class="container">
                <div class="form-page-top-state">
                    <span @click="back()" class="arrow-back">&larr; Назад</span>
                    <router-link to="/"  class="back-link" @click="closeModal()"><span></span></router-link>
                </div>
                <h2 class="modal-section__h">Получить консультацию</h2>
                <p class="modal-section__p">Отправьте Ваши данные, чтобы мы смогли с Вами связаться</p>
                <form class="register-from" id="register-from" @submit.prevent="ev => {register(ev)}">
                    <label class="register-from__label">
                        <p class="register-from__p">Ваше имя</p>
                        <input class="register-from__input-text" type="text" required name="name" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш Email</p>
                        <input class="register-from__input-text" type="email" name="email" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш телефон</p>
                        <input class="register-from__input-text" type="tel" required name="tel" placeholder="">
                    </label>
                    <input class="register-from__submit" type="submit" value="Отправить">
                </form>
            </div>
        </section>
        <section v-else class="modal-section">
            <div class="container">
                <h2 class="modal-section__h">Заявка успешно отправлена!</h2>
                <p class="modal-section__p">Мы перезвоним Вам течение дня</p>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';
import ajaxConf from "../config/ajax";
import modalMessage from './modalMessage.vue';
export default {
    components:{
        modalMessage
    },
    data() {
        return {
            modalLoader: false,
            sendedEmail: false,
            successModal: false,
            modalMessage: [
                'Успешно отправлено!',
                "green",
                "✔"
            ]
        }
    },
    methods: {
        back(){
            history.back()
        },
        register(n) {
            // console.log(new FormData(n.target));
            const formData = new FormData(n.target);
            this.modalLoader = true;
            const context = this;
            setTimeout(()=> {
                axios.post(ajaxConf.action('sendkonsult'), formData)
                    .then(function(response) {
                        context.modalLoader = false;
                        context.successModal = true;
                        setTimeout(()=>{
                            context.successModal = false;
                            context.sendedEmail = true;
                        }, 3000);
                    })
                    .catch(function(err) {
                        context.modalLoader = false;
                        alert('Ошибка сервера, повторите позже');
                    })
                    .finally(function() {
                        context.modalLoader = false;
                    })
            }, 500)
            
        }
    }
}
</script>



<style lang="scss" scoped>
.modal-wrapper__loader {
    position: fixed;
    top: 0;
    width: 100vw;
    height: 100vh;
    left: 0;
    z-index: 1100;
    background-color: #efefefba;
}
</style>