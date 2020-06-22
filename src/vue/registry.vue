<template>
    <div class="modal-wrapper">
        <div v-if="loaderModal" class="modal-wrapper__loader"></div>
        <section id="online-registration" class="modal-section" style="display: block">
            <div class="container">
                <a href="#" class="back-link" @click="closeModal()"><span></span></a>
                <h2 class="modal-section__h">Записаться на курс</h2>
                <p class="modal-section__p">Заполните форму, чтобы записаться на курс. После завершения записи вам позвонит наш менеджер, определит вам преподавателя и соорентирует вас по времени проведения уроков. Указывайте пожалуйста реальные данные. Если у вас есть вопросы по курсу, то можете <a href="#">заказать звонок</a></p>
                <form class="register-from" id="register-from" @submit.prevent="ev => {register(ev)}">
                    <label class="register-from__label">
                        <p class="register-from__p">Ваше ФИО</p>
                        <input class="register-from__input-text" type="text" name="name" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш Email</p>
                        <input class="register-from__input-text" type="email" name="email" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш телефон</p>
                        <input class="register-from__input-text" type="tel" name="tel" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <span class="register-from__span">Обучение проходит три раза в неделю, в понедельник, в среду и в пятницу. Урок длится 1 час 30 минут.</span>
                        <p class="register-from__p">Выберите удобное для вас время суток</p>
                        <select class="register-from__select" name="prefer-time">
                            <option value="morning">Утро</option>
                            <option value="lunch">Обед</option>
                            <option value="dinner">Вечер</option>
                        </select>
                    </label>
                    <input class="register-from__submit" type="submit" value="Далее">
                </form>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';
import ajaxConf from "../config/ajax";

export default {
    data() {
        return {
            loaderModal: false
        }
    },
    methods: {
        register(n) {
            // console.log(new FormData(n.target));
            const formData = new FormData(n.target);
            this.loaderModal = true;
            const context = this;
            setTimeout(()=> {
                axios.post(ajaxConf.action('registry'), formData)
                    .then(function(response) {
                        console.log(response);
                        console.log(response.data);
                        context.loaderModal = false;
    
                    })
                    .catch(function(err) {
                        context.loaderModal = false;
                        console.log(err);
                        alert('Ошибка сервера, повторите позже');
                    })
                    .finally(function() {
                        context.loaderModal = false;
                    })
            }, 3000)
            
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