<template>
    <div>
        <modalMessage v-if="successModal" :message="modalMessage[0]" :color="modalMessage[1]" :sign="modalMessage[2]"></modalMessage>
        <div class="signin-modal">
            <div v-if="modal" class="signin-modal__loader"></div>
            <div>

                <div class="form-page-top-state">
                    <span @click="back()" class="arrow-back arrow-back--white">&larr; Назад</span>
                    <!-- <router-link to="/"  class="back-link" @click="closeModal()"><span></span></router-link> -->
                </div>
            <form class="signin-form" id="signin-form" @submit.prevent="signIn">
                <p class="signin-form__p">Личный кабинет</p>
                <input type="email" required="required" name="email" placeholder="email" class="discount-form__input">
                <input type="password" required="required" name="password" placeholder="Пароль" class="discount-form__input">
                <input type="submit" value="Войти" class="discount-form__submit">
            </form>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import config from '../config/ajax';
import modalMessage from './modalMessage.vue';
import router from  '../vueplugins/vue-router';

export default {
    components: {
        modalMessage
    },
    data(){
        return {
            modal: false,
            modalMessage: ["Успешно!", "green", "✔"],
            successModal: false
        }
    },
    methods: {
        back(){
            history.back();
        },
        signIn() {
            this.modal = true;
            const formData = new FormData(document.getElementById('signin-form'));
            axios.post(config.action('signin'), formData)
            .then(res => {
                // console.log(res.data);
                this.modal = false;
                if (res.data.status == "signed") {
                    this.modalMessage = ["Успешно!", "green", "✔"];
                    this.successModal = true;
                    setTimeout(()=>{
                        router.replace('/cabinet');
                    }, 1000);
                } else {
                    this.successModal = true;
                    this.modalMessage = ["Неправильный логин или пароль!", "red", "☹"];
                    setTimeout(()=>{
                        this.successModal = false;
                    }, 3000);
                }

                
            })
            .catch(err => {
                this.modal = false;
                // console.log(err);
                alert('Ошибка сервера');
            })
            .finally(() => {
                this.modal = false;
                
            })
        }
    },
    mounted(){
        axios.get(config.action('checkreg'))
        .then((res)=>{
            // console.log(res.data);
            if (res.data.email != false && res.data.email != null) {
                router.replace('/cabinet');
            }
        });
    }

}
</script>

<style lang="scss" >
    .signin-modal {
        position: fixed;
        padding: 3em;
        padding-top: 10em;
        display: flex;
        top: 0;
        left: 0;
        overflow: auto;
        width: 100vw;
        height: 100vh;
        justify-content: center;
            background-color: #00000033;
        align-items: flex-start;
        &__loader {
            position: fixed;
            height: 100vh;
            width: 100vw;
            background-color: #00000033;
            top: 0;
            left: 0;
        }
    }
    .signin-form {
        display: flex;
        margin-top: 1em;
        flex-direction: column;
        width: 30em;
        background-color: #fff;
        padding: 3em;
        border-radius: 1em;
        input {
            border: 1px solid transparent;
            width: 100%;
            &:not(:first-child) {
                margin-top: 1.5em;
            }
            &:not([type="submit"]) {
                &:focus {
                    border: 1px solid;
                }
                background-color: #f9f9f5;
            }
            &[type="submit"] {
                cursor: pointer;
                &:hover {
                    background-color: #8587ff;
                }
            }
        }
        &__p {
            // margin-top: 1em;
            text-transform: uppercase;
            font-size: 1.5em;
            font-weight: bold;
            text-align: center;
            color: rgb(27, 26, 26);
        }
    }
    .arrow-back--white {
        color: white;
        &:hover {
            color: #ddd;
        }
    }
</style>