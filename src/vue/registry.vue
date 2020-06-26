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
                <p v-if="freeplaces == 0 && dataGetted" class="modal-section__p modal-section__p--danger">В данный момент у нас нет свободных преподавателей, но Вы можете оставить свою запись на будущее и мы вам с радостью перезвоним, как освободится место! :)</p>
                <h2 class="modal-section__h">Записаться на курс</h2>
                <p class="modal-section__p">Заполните форму, чтобы записаться на курс. После завершения записи Вам на почту придет письмо с данными для входа в личный кабинет. Также Вам позвонит наш менеджер и сориентирует по процессу обучения. Указывайте, пожалуйста, реальные данные. Если у Вас есть вопросы по курсу, то можете <router-link to="/callback">заказать звонок</router-link></p>
                <form class="register-from" id="register-from" @submit.prevent="ev => {register(ev)}">
                    <label class="register-from__label">
                        <p class="register-from__p">Ваше ФИО</p>
                        <input class="register-from__input-text" required type="text" name="name" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш Email</p>
                        <input class="register-from__input-text" required type="email" name="email" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш телефон</p>
                        <input class="register-from__input-text" required type="tel" name="tel" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <span class="register-from__span">Обучение проходит три раза в неделю, в понедельник, в среду и в пятницу. Урок длится 1 час 30 минут.</span>
                        <p class="register-from__p">Выберите удобное для Вас время суток</p>
                        <select class="register-from__select" name="prefer-time">
                            <option value="morning">Утро</option>
                            <option value="lunch">Обед</option>
                            <option value="dinner">Вечер</option>
                            <option value="all">Могу в любое время</option>
                        </select>
                    </label>
                    <input class="register-from__submit" type="submit" value="Далее">
                </form>
            </div>
        </section>
        <section v-else class="modal-section">
            <div class="container">
                <h2 class="modal-section__h">Данные для входа отправлены Вам на почту</h2>
                <p class="modal-section__p">На Ваш email-адрес было отправлено письмо с ссылкой и данными для входа в кабинет. Если письмо не пришло - проверьте папку "Спам". С помощью личного кабинета Вы сможете следить за прогрессом вашего обучения :)</p>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';
import ajaxConf from "../config/ajax";
import modalMessage from './modalMessage.vue';
import freeplaces from '../config/freeplaces';
export default {
    components:{
        modalMessage
    },
    data() {
        return {
            dataGetted: false,
            freeplaces: freeplaces.count,
            modalLoader: false,
            sendedEmail: false,
            successModal: false,
            modalMessage: [
                'Данные для входа отправлены на Вашу почту!',
                "green",
                "✔"
            ]
        }
    },
    mounted(){
        axios.get('/api/freeplaces')
        .then(res => {
            // console.log(res);
            this.dataGetted = true;
            this.freeplaces = freeplaces.max + freeplaces.count - res.data.count;
            if (this.freeplaces < 0) {
                this.freeplaces = 0;
            }
        });
    },
    methods: {
        back(){
            history.back();
        },
        register(n) {
            // console.log(new FormData(n.target));
            const formData = new FormData(n.target);
            this.modalLoader = true;
            const context = this;
            setTimeout(()=> {
                axios.post(ajaxConf.action('registry'), formData)
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