<template>
    <div class="modal-wrapper">
        <section id="user-cabinet" class="modal-section">
            <section class="user-info">
                <div class="user-info__color-section">
                    <router-link to="/" class="logo-wrapper user-info__logo-wrapper">
                        <img src="/img/logo.jpg" alt="LayCode - logo" class="logo logo--opened">
                        LayCode
                    </router-link>
                    <div class="user-info__item-user">
                        <span class="user-info__student-id"><b>id:</b> {{user.id}}</span>
                        <p class="user-info__student-name">{{user.name}}</p>
                    </div>
                    <div class="form-page-top-state">
                        <span @click="signout()" class="arrow-back" style="color: #989898">&larr; Выйти</span>
                    </div>
                    <form  class="time-block" id="cabinet-time-block" @submit.prevent="setPreferTime()">
                        <span v-if="!user.buyFirstModul" class="time-block__blocked">Время обучения можно выбрать после открытия модуля</span>
                        <div v-if="!user.buyFirstModul" class="time-block__time-shower">
                            Свободное время:
                            <div class="time-block__time-table">
                                <template v-for="(item,i) in time">
                                    <span v-if="!item.disabled" :key="i">
                                    {{item.text}}

                                    </span>
                                </template>

                            </div>
                        </div>
                        <label v-else-if="user.studyTime == null" class="register-from__label">
                            <p class="register-from__p">Выберите удобное для Вас время обучения</p>
                            <span class="register-from__span">Время будет закреплено за Вами и его <b>нельзя</b> будет изменить</span>
                            <select style="margin-top: 1em;" class="register-from__select" name="user-study-time">
                                <option class="cabinet-input-option"  v-for="(item,i) in time" :key="i" :value="item.time" :disabled="item.disabled">
                                    {{item.text}}
                                    <span v-if="item.disabled" class="cabinet-input-option__helper" > - занято</span>
                                </option>
                            </select>
                        </label>
                        <input v-if="user.buyFirstModul && user.studyTime == null" class="register-from__submit cabinet-submit-btn" type="submit" value="Выбрать время">
                        <span v-if="user.studyTime != null" class="time-block__time-shower">Время Вашего урока: <span class="time-block__time-shower--integers">{{ time[user.studyTime].text }}</span></span>
                    </form>
                    <div>
                        <span class="usloviya-polsovania">
                            Пользуясь нашим сервисом, Вы соглашаетесь с <a href="/Uslovia_obuchenia_1.pdf" target="_blank">условиями обучения</a> 
                        </span>
                    </div>
                </div>
                <div class="user-info__item">
                    <span class="user-info__item-span">Ваш преподаватель:</span>
                    <p class="user-info__item-p">Ташманов Саид Сергеевич</p>
                    <ul class="user-info__item-ul">
                        <li style="font-size: 1.3em; color: #609c00;"><b>Discord:</b> Said#8843</li>
                        <li><b>Skype:</b> live:alright.said.offcl</li>
                        <li><b>VK:</b> <a href="https://vk.com/said_vi" style="text-decoration: underline;" target="_blank">said_vi</a></li>
                        <li><b>Whatsapp:</b> +7 708 630 0760</li>
                    </ul>
                </div>
            </section>
            <section class="user-lessons">
                <div v-if="paycart !== 'none'" class="open-access-modal">
                    <div v-if="paycart == 'first'" class="pay-cart">
                        <a href="#" @click="closeModalPaycart()" class="back-link pay-cart__back-link"><span></span></a>
                        <span class="pay-cart__text">
                            Открыть доступ к модулю
                        </span>
                        <span class="pay-cart__name">Веб-вёрстка с нуля</span>
                        <span class="pay-cart__price">61&nbsp;250&nbsp;ТГ | 10&nbsp;550&nbsp;РУБ</span>
                        <iframe class="pay-cart__btn" src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%B7%D0%B0%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8C%20%22%D0%92%D0%B5%D0%B1-%D0%B2%D1%91%D1%80%D1%81%D1%82%D0%BA%D0%B0%20%D1%81%20%D0%BD%D1%83%D0%BB%D1%8F%22&default-sum=10550&button-text=11&any-card-payment-type=on&button-size=m&button-color=orange&fio=on&phone=on&mail=on&successURL=&quickpay=small&account=4100115477732227&" width="184" height="36" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                        <span class="pay-cart__text">* При переводе укажите данные Вашего аккаунта</span>
                        <span class="usloviya-polsovania">
                            Пользуясь нашим сервисом, Вы соглашаетесь с <a href="/Uslovia_obuchenia_1.pdf" target="_blank">условиями обучения</a> 
                        </span>
                    </div>
                    <div v-if="paycart == 'second'" class="pay-cart">
                        <a href="#" @click="closeModalPaycart()" class="back-link pay-cart__back-link"><span></span></a>
                        <span class="pay-cart__text">
                            Открыть доступ к модулю
                        </span>
                        <span class="pay-cart__name">Веб-вёрстка PRO</span>
                        <span class="pay-cart__price">61&nbsp;250&nbsp;ТГ | 10&nbsp;550&nbsp;РУБ</span>
                        <iframe v-if="user.buyFirstModul" class="pay-cart__btn"  src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9E%D0%BF%D0%BB%D0%B0%D1%82%D0%B0%20%D0%B7%D0%B0%20%D0%BC%D0%BE%D0%B4%D1%83%D0%BB%D1%8C%20%22%D0%92%D0%B5%D0%B1-%D0%B2%D1%91%D1%80%D1%81%D1%82%D0%BA%D0%B0%20PRO%22&default-sum=10550&button-text=11&any-card-payment-type=on&button-size=m&button-color=orange&fio=on&phone=on&mail=on&successURL=&quickpay=small&account=4100115477732227&" width="184" height="36" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                        <span v-else class="pay-cart__name">Можно открыть после первого модуля</span>
                        <span class="pay-cart__text">* При переводе укажите данные Вашего аккаунта</span>
                        <span class="usloviya-polsovania">
                            Пользуясь нашим сервисом, Вы соглашаетесь с <a href="/Uslovia_obuchenia_1.pdf" target="_blank">условиями обучения</a> 
                        </span>
                    </div>
                </div>
                <div class="user-lessons__container">
                    <div class="study-plan user-lessons__study-plan">
                        <div class="study-plan__top">
                            <h2>Процесс обучения</h2> 
                            <p>Здесь Вы можете следить за прогрессом своего обучения</p>
                        </div> 
                        <div class="study-plan__list">
                            <ol class="study-plan__ol">
                                <li class="study-plan__ol-li " :class="isActived('top')" @click.prevent="(ev)=> {changeActived('top', ev)}">
                                    <div class="cabinet-plan-h">
                                        <span>
                                            1. Веб-вёрстка с нуля 
                                        </span>
                                        <span v-if="!user.buyFirstModul" class="cabinet-plan-h__status cabinet-plan-h__status--red">
                                            Не доступно
                                        </span>
                                        <span v-else class="cabinet-plan-h__status">
                                            Доступно
                                        </span>
                                        <span v-if="!user.buyFirstModul && freeplaces != 0" class="cabinet-open-accses">
                                            <a href="#" class="qwertya" @click.prevent="openModalPaycart('first')">Открыть доступ</a>
                                        </span>
                                        <span v-else-if="freeplaces == 0 && !user.buyFirstModul" class="cabinet-plan-h__status cabinet-plan-h__status--yellow">
                                            Нет мест
                                        </span>
                                    </div>
                                    <ul class="study-plan__ul">
                                        <li v-for="(item, i) in firstModul" :key="i" class="study-plan__ul-li">
                                            <span>
                                                {{item.text}}
                                            </span>
                                            <span v-if="!item.status" class="study-plan__ul-li-status">
                                                <span v-if="item.fined" class="study-plan__removed study-plan__removed--red">
                                                    штраф
                                                </span>
                                                <span v-if="item.removed" class="study-plan__removed">
                                                    перенесено
                                                </span>
                                                ✔
                                            </span>
                                            <span v-else class="study-plan__ul-li-status" style="color:green">
                                               <span v-if="item.fined" class="study-plan__removed study-plan__removed--red">
                                                    штраф
                                                </span>
                                               <span v-if="item.removed" class="study-plan__removed">
                                                    перенесено
                                                </span> ✔
                                            </span>
                                        </li>
                                    </ul>
                                </li> 
                                <li class="study-plan__ol-li" :class="isActived('bottom')" @click="ev => {changeActived('bottom', ev)}"> 
                                    <div class="cabinet-plan-h">
                                        <span>
                                            2. Веб-вёрстка PRO
                                        </span>
                                        <span v-if="!user.buySecondModul" class="cabinet-plan-h__status cabinet-plan-h__status--red">
                                            Не доступно
                                        </span>
                                        <span v-else class="cabinet-plan-h__status">
                                            Доступно
                                        </span>
                                        <span v-if="!user.buySecondModul && freeplaces != 0" class="cabinet-open-accses">
                                            <a href="#" class="qwertya" @click.prevent="openModalPaycart('second')">Открыть доступ</a>
                                        </span>
                                        <span v-else-if="user.buyFirstModul && !user.buySecondModul" class="cabinet-open-accses">
                                            <a href="#" class="qwertya" @click.prevent="openModalPaycart('second')">Открыть доступ</a>
                                        </span>
                                        <span v-else-if="freeplaces == 0 && !user.buySecondModul" class="cabinet-plan-h__status cabinet-plan-h__status--yellow">
                                            Нет мест
                                        </span>
                                    </div> 
                                    <ul class="study-plan__ul">
                                        <li v-for="(item, i) in secondModul" :key="i" class="study-plan__ul-li">
                                            <span>
                                                {{item.text}}
                                            </span>
                                            <span v-if="!item.status" class="study-plan__ul-li-status">
                                                <span v-if="item.fined" class="study-plan__removed study-plan__removed--red">
                                                    штраф
                                                </span>
                                                <span v-if="item.removed" class="study-plan__removed">
                                                    перенесено
                                                </span>✔
                                            </span>
                                            <span v-else class="study-plan__ul-li-status" style="color:green">
                                                <span v-if="item.fined" class="study-plan__removed study-plan__removed--red">
                                                    штраф
                                                </span>
                                                <span v-if="item.removed" class="study-plan__removed">
                                                    перенесено
                                                </span>✔
                                            </span>
                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
</template>
<script>
import axios from 'axios';
import freeplaces from '../config/freeplaces';
import router from  '../vueplugins/vue-router';


export default {
    name: 'cabinet',
    data() {
        return {
            time: {
                "10-00": {time: "10-00", text: '10:00 - 11:00', disabled: false},
                "11-30": {time: "11-30", text: '11:30 - 12:30', disabled: false},
                "13-00": {time: "13-00", text: '13:00 - 14:00', disabled: false},
                "14-30": {time: "14-30", text: '14:30 - 15:30', disabled: false},
                "16-00": {time: "16-00", text: '16:00 - 17:00', disabled: false},
                "17-30": {time: "17:30", text: '17:30 - 18:30', disabled: false},
            },
            freeplaces: freeplaces.count,
            studyTabs: {
                top: true,
                bottom: false
            },
            paycart: 'none', // 'first', 'second', 'none'
            user: {
                id: "null",
                name: "null",
                buyFirstModul: false,
                buySecondModul: false,
                studyTime: null
            },
            firstModul: [
                {fined: false, removed: false, text: "Введение", status: 0},
                {fined: false, removed: false, text: "Базовый HTML", status: 0},
                {fined: false, removed: false, text: "Базовый CSS", status: 0},
                {fined: false, removed: false, text: "Работа с макетом", status: 0},
                {fined: false, removed: false, text: "Advanced HTML", status: 0},
                {fined: false, removed: false, text: "HTML формы", status: 0},
                {fined: false, removed: false, text: "Advanced CSS", status: 0},
                {fined: false, removed: false, text: "Адаптивность", status: 0},
                {fined: false, removed: false, text: "Доступность. Кроссбраузерность", status: 0},
            ],
            secondModul: [
                {fined: false, removed: false, text: "JavaScript для верстальщика", status: 0},
                {fined: false, removed: false, text: "Git", status: 0},
                {fined: false, removed: false, text: "Работа с хостингом", status: 0},
                {fined: false, removed: false, text: "Мини проект", status: 0},
                {fined: false, removed: false, text: "HTML письма", status: 0},
                {fined: false, removed: false, text: "Препроцессоры и постпроцессоры", status: 0},
                {fined: false, removed: false, text: "css Grid", status: 0},
                {fined: false, removed: false, text: "css Анимации", status: 0},
                {fined: false, removed: false, text: "Системы управления контентом. CMS", status: 0},
                {fined: false, removed: false, text: "Итоговая работа", status: 0},

            ]
        }
    },
    mounted(){        
        axios.post('/api/getfreetimes')
        .then(res => {
            res.data.forEach(item => {
                if (item.user_study_time != null) {
                    this.time[item.user_study_time].disabled = true;
                }
            })
            
        });
        axios.get('/api/freeplaces')
        .then(res => {
            // console.log(res);
            this.freeplaces = freeplaces.max + freeplaces.count - res.data.count;
            if (this.freeplaces < 0) {
                this.freeplaces = 0;
            }
        });
        axios.get('/api/checkreg')
        .then((res)=>{
            if (res.data.email == false || res.data.email == null) {
                router.replace('/signin');
            } else {
                axios.get('/api/userdata')
                .then((res)=>{
                    // console.log(res.data);
                    
                    const user = res.data.user;
                    this.user.name = res.data.user.name;
                    this.user.id = "440" + res.data.user.id;
                    this.user.studyTime = res.data.user.user_study_time;
                    if (user.buyfirst != "0") {
                        this.user.buyFirstModul = true;
                    }
                    if (user.buysecond != "0") {
                        this.user.buySecondModul = true;
                    }
                    if (user.firstmodal !== null && user.buyfirst != "0") {
                        const arr = user.firstmodal.split(',');
                        const context = this;
                        arr.forEach(el => {
                            context.firstModul[el - 1].status = 1;
                        });
                    }
                    if (user.secondmodal !== null && user.buysecond != "0") {
                        const arr = user.secondmodal.split(',');
                        const context = this;
                        arr.forEach(el => {
                            context.secondModul[el - 1].status = 1;
                        });
                    }
                    //
                    if (user.first_modal_removed !== null && user.buyfirst != "0") {
                        const arr = user.first_modal_removed.split(',');
                        const context = this;
                        arr.forEach(el => {
                            context.firstModul[el - 1].removed = true;
                        });
                    }
                    if (user.second_modal_removed !== null && user.buysecond != "0") {
                        const arr = user.second_modal_removed.split(',');
                        const context = this;
                        arr.forEach(el => {
                            context.secondModul[el - 1].removed = true;
                        });
                    }
                    //
                    //
                    if (user.first_modal_fined !== null && user.buyfirst != "0") {
                        const arr = user.first_modal_fined.split(',');
                        const context = this;
                        arr.forEach(el => {
                            context.firstModul[el - 1].fined = true;
                        });
                    }
                    if (user.second_modal_fined !== null && user.buysecond != "0") {
                        const arr = user.second_modal_fined.split(',');
                        const context = this;
                        arr.forEach(el => {
                            context.secondModul[el - 1].fined = true;
                        });
                    }
                })
                .catch((res)=>{
                    // console.log(res);
                    alert('Ошибка сервера');
                })
                .finally(()=>{
                    // console.log(res);
                });
            }
        });
        
    },
    methods: {
        setPreferTime(){
            const formData = new FormData(document.getElementById('cabinet-time-block'));
            const context = this;
            const btn = document.querySelector('.cabinet-submit-btn');
            btn.setAttribute('disabled', 'disabled');

            axios.post('/api/setprefertime', formData)
            .then(res=> {
                // console.log(res.data);
                if (res.data.set) {
                    context.user.studyTime = res.data.studyTime;
                } else {
                    alert("Ошибка сервера! Повторите попытку или свяжитесь с администратором!");
                }
            }).finally(()=>{
                setTimeout(() => {
                    btn.removeAttribute('disabled');
                }, 500);
                
            });
        },
        signout(){
            axios.get("/api/signout")
            .then(res =>{
                // console.log(res.data);
                router.replace("/");
                
            })
        },
        closeModalPaycart() {
            this.paycart = 'none';
        },
        openModalPaycart(n) {
            this.paycart = n;
        },
        isActived(n) {
            if (this.studyTabs[n] == true) {return 'active';}
            else {return '';}
        },
        changeActived(n, ev) {
            
            if (ev.target.classList.value != "qwertya") {
                this.studyTabs[n] = !this.studyTabs[n];
            }
        }
    }
}
</script>



<style lang="scss">
.time-block {
    border: 1px solid #d9d2ff;
    padding: .5em 1em 2em;
}
.cabinet-submit-btn {
    background-color: #bbafff;
    &:hover {
        background-color: #9a8eda;
    }
}
.cabinet-plan-h {
    display: flex; 
    justify-content: space-between;
    align-items: center;
    &__status {
        font-size: 0.8em;
        color: #039103;
        &--red {
            color: #e42929e3;
        }
        &--yellow {
            color: #9e760a;
        }
    }
}
.cabinet-open-accses {
    font-size: .8em;
    color: rgb(49, 49, 235);
    &:hover {
        text-decoration: underline;
    }
}
// .user-lessons {
//     position: relative;
// }
.open-access-modal {
    position: fixed;
    width: 100vw;
    top: 0;
    left: 0;
    // border: 1px solid green;
    min-height: 100vh;
    background-color: #0000001e;
    display: flex;
    align-items: center;
    justify-content: center;
}
@function toEm($px, $em: 16) {
    @return ($px / $em) + em;
}
.pay-cart {
    background-color: #fff;
    padding: 4em 7em 2em 5em;
    flex-grow: 0;
    display: flex;
    flex-direction: column;
    // width: 50em;
    // align-items: center;
    &__text {
        margin-top: 1em;
        font-size: toEm(20);
    }
    &__name {
        margin-top: .5em;
        font-size: 2em;
        font-weight: bold;
    }
    &__price {
        margin-top: .7em;
        font-size: 2em;
        color: #4766ff;
        text-transform: uppercase;
    }
    &__btn {
        margin-top: 3em;
    }
    position: relative;
    &__back-link {
        margin: 0;
        position: absolute;
        top: 1em;
        right: 1em;
    }
}
.study-plan__ul-li-status {
    color: #c9cace;
    width: max-content;
    display: inline-flex;
    margin-left: .5em;
}
.study-plan__ul-li {
    display: flex;
    justify-content: space-between;
}
.time-block {
    margin-top: 1em;
    &__blocked {
        font-size: toEm(20);
        color: #ea5700;
    }
    &__time-table {
        display: flex;
        flex-direction: column;
        border: 1px solid #e6e1ff;
        span {
            padding: .5em 0;
            color: #383838;
            &:nth-child(2n-1) {
                background-color: #e6e1ff;
            }
        }

    }
}
.cabinet-input-option {
    &__helper {
        color: #ea5700;
    }
}
.time-block__time-shower {
    font-size: 1.5em;
    display: block;
    margin-top: 1em;
    text-align: center;
    &--integers {
        background-color: #e8e3f7;
        padding: .5em;
        color: #00671b;
        width: max-content;
        display: inline-block;
    }
}
.study-plan__removed {
    color: #ea8200;
    padding-right: 1em;
    &--red {
        color: #990000;
    }
}
.usloviya-polsovania {
    font-size: 1.3em;
    margin-top: 1em;
    display: block;
    a {
        color: blue;
    }
}
</style>