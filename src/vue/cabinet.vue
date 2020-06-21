<template>
    <div class="modal-wrapper">
        <section id="user-cabinet" class="modal-section">
            <section class="user-info">
                <div class="user-info__color-section">
                    <div class="user-info__logo-wrapper">LayCode</div>
                    <div class="user-info__item-user">
                        <span class="user-info__student-id"><b>id:</b> 4408</span>
                        <p class="user-info__student-name">Ташманов Саид Сергеевич</p>
                    </div>
                </div>
                <div class="user-info__item">
                    <span class="user-info__item-span">Ваш преподаватель:</span>
                    <p class="user-info__item-p">Ташманов Саид Сергеевич</p>
                    <ul class="user-info__item-ul">
                        <li><b>Skype:</b> @myskype</li>
                        <li><b>VK:</b> said_vivas</li>
                        <li><b>Whatsapp:</b> +77086300760</li>
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
                        <span class="pay-cart__price">61 250 ТГ | 10 550 РУБ</span>
                        <iframe class="pay-cart__btn" src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9C%D0%BE%D0%B4%D1%83%D0%BB%D1%8C%3A%20%D0%92%D0%B5%D0%B1-%D0%B2%D1%91%D1%80%D1%81%D1%82%D0%BA%D0%B0%20%D1%81%20%D0%BD%D1%83%D0%BB%D1%8F&default-sum=10&button-text=12&any-card-payment-type=on&button-size=m&button-color=orange&fio=on&phone=on&mail=on&successURL=http%3A%2F%2Flocalhost%3A8080%2Fcabinet&quickpay=small&account=4100115477732227&" width="184" height="36" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                        <span class="pay-cart__text">* При переводе укажите данные вашего аккаунта</span>
                    </div>
                    <div v-if="paycart == 'second'" class="pay-cart">
                        <a href="#" @click="closeModalPaycart()" class="back-link pay-cart__back-link"><span></span></a>
                        <span class="pay-cart__text">
                            Открыть доступ к модулю
                        </span>
                        <span class="pay-cart__name">Веб-вёрстка PRO</span>
                        <span class="pay-cart__price">61 250 ТГ | 10 550 РУБ</span>
                        <iframe class="pay-cart__btn" src="https://money.yandex.ru/quickpay/button-widget?targets=%D0%9C%D0%BE%D0%B4%D1%83%D0%BB%D1%8C%3A%20%D0%92%D0%B5%D0%B1-%D0%B2%D1%91%D1%80%D1%81%D1%82%D0%BA%D0%B0%20%D1%81%20%D0%BD%D1%83%D0%BB%D1%8F&default-sum=10&button-text=12&any-card-payment-type=on&button-size=m&button-color=orange&fio=on&phone=on&mail=on&successURL=http%3A%2F%2Flocalhost%3A8080%2Fcabinet&quickpay=small&account=4100115477732227&" width="184" height="36" frameborder="0" allowtransparency="true" scrolling="no"></iframe>
                        <span class="pay-cart__text">* При переводе укажите данные вашего аккаунта</span>
                    </div>
                </div>
                <div class="user-lessons__container">
                    <div class="study-plan user-lessons__study-plan">
                        <div class="study-plan__top">
                            <h2>Процесс обучения</h2> 
                            <p>Обучение разделенно на два больших модуля. С уроками этих модулей вы можете ознакомиться здесь</p>
                        </div> 
                        <div class="study-plan__list">
                            <ol class="study-plan__ol">
                                <li class="study-plan__ol-li " :class="isActived('top')" @click="changeActived('top')">
                                    <div class="cabinet-plan-h">
                                        <span>
                                            1. Веб-вёрстка с нуля 
                                        </span>
                                        <span class="cabinet-plan-h__status cabinet-plan-h__status--red">
                                            Не доступно
                                        </span>
                                        <span class="cabinet-open-accses">
                                            <a href="#" @click.prevent="openModalPaycart('first')">Открыть доступ</a>
                                        </span>
                                    </div>
                                    <ul class="study-plan__ul">
                                        <li class="study-plan__ul-li">Введение</li> 
                                        <li class="study-plan__ul-li">Базовый HTML</li> 
                                        <li class="study-plan__ul-li">Базовый CSS</li> 
                                        <li class="study-plan__ul-li">Работа с макетом</li> 
                                        <li class="study-plan__ul-li">Вёрстка</li> 
                                        <li class="study-plan__ul-li">Advanced HTML</li> 
                                        <li class="study-plan__ul-li">HTML формы</li> 
                                        <li class="study-plan__ul-li">Advanced CSS</li> 
                                        <li class="study-plan__ul-li">Адаптивность</li> 
                                        <li class="study-plan__ul-li">Доступность. Кроссбраузерность</li>
                                    </ul>
                                </li> 
                                <li class="study-plan__ol-li" :class="isActived('bottom')" @click="changeActived('bottom')"> 
                                    <div class="cabinet-plan-h">
                                        <span>
                                            2. Веб-вёрстка PRO
                                        </span>
                                        <span class="cabinet-plan-h__status cabinet-plan-h__status--red">
                                            Не доступно
                                        </span>
                                        <span class="cabinet-open-accses">
                                            <a href="#" @click.prevent="openModalPaycart('second')">Открыть доступ</a>
                                        </span>
                                    </div> 
                                    <ul class="study-plan__ul">
                                        <li class="study-plan__ul-li">JavaScript для верстальщика</li> 
                                        <li class="study-plan__ul-li">Git</li> 
                                        <li class="study-plan__ul-li">Работа с хостингом</li> 
                                        <li class="study-plan__ul-li">Мини проект</li> 
                                        <li class="study-plan__ul-li">HTML письма</li> 
                                        <li class="study-plan__ul-li">Препроцессоры и постпроцессоры</li> 
                                        <li class="study-plan__ul-li">css Grid</li> 
                                        <li class="study-plan__ul-li">css Анимации</li> 
                                        <li class="study-plan__ul-li">Системы управления контентом. CMS</li> 
                                        <li class="study-plan__ul-li">Итоговая работа</li>
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
export default {
    name: 'cabinet',
    data() {
        return {
            studyTabs: {
                top: true,
                bottom: false
            },
            paycart: 'none', // 'first', 'second', 'none'
        }
    },
    methods: {
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
        changeActived(n) {
            this.studyTabs[n] = !this.studyTabs[n];
        }
    }
}
</script>



<style lang="scss">
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
</style>