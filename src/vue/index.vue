<template>
    <div>
        <modalMessage v-if="isModalMessage" :message="modalMessage[0]" :color="modalMessage[1]" :sign="modalMessage[2]"></modalMessage>
        <header :class="[headerClassActive, navActived]">
            <div class="container header-container">
                <div class="logo-wrapper">
                    <img v-if="logoHeaderOpened" src="/img/logo.jpg" alt="LayCode - logo" class="logo logo--opened">
                    <img v-else src="/img/logo-white.png" alt="LayCode - logo" class="logo">
                    LayCode
                </div>
                <nav :class="navActived" @click="closeMenu()">
                    <ul class="header-menu">
                        <!-- <li class="header-menu__item"><a href="#" v-scroll-to="''">Меню</a></li> -->
                        <li class="header-menu__item"><a href="#" v-scroll-to="'#be-webmaster'">Быть верстальщиком</a></li>
                        <li class="header-menu__item"><a href="#" v-scroll-to="'#course-features'">Наш курс</a></li>
                        <li class="header-menu__item"><a href="#" v-scroll-to="'#how-to-study'">Обучение</a></li>
                        <li class="header-menu__item"><a href="#" v-scroll-to="'#price'">Условия</a></li>
                        <li class="header-menu__item"><router-link to="/signin" v-scroll-to="'#price'">Войти</router-link></li>
                    </ul>
                </nav>
                <button class="mobile-burger" :class="navActived" @click="activeNav()">
                    <span></span>    
                </button>
                <!-- <a href="#"></a> -->
            </div>
        </header>
        <main>
            <section id="web-layouts-course">
                <div class="container">
                    <div class="page-face">
                        <h1 class="page-face__title"><span>Индивидуальный курс</span><span>Веб-вёрстка с нуля до&nbsp;PRO</span></h1>
                        <p>Для тех, кто хочет освоить профессию HTML-Верстальщика, научиться web-разработке и изменить свою профессию всего лишь за 2 месяца!</p>
                        <router-link to="../registry" class="white-btn">Подключиться</router-link>
                    </div>
                    <div class="html-css-img">
                        <img src="/img/htlm.png" class="html-css-img__html" alt="html">
                        <img src="/img/css3.png" class="html-css-img__css" alt="css">
                    </div>
                </div>
            </section>
            <section id="be-webmaster">
                <div class="be-webmaster_top">
                    <div class="container">
                        <h2 class="section-h2"><span class="section-h2__top-str">Что значит быть</span><span class="section-h2__second-string">верстальщиком</span><span class="section-h2__sign">?</span></h2>
                    </div>
                </div>
                <div class="be-webmaster_bottom">
                    <div class="container">
                        <ul class="webmaster-pluses">
                            <li class="webmaster-pluses__item">
                                <img  class="webmaster-pluses__img" src="/img/team.jpg" alt="Работа в команде">
                                <div class="webmaster-pluses__title">Работа в команде</div>
                                <p class="webmaster-pluses__text">Верстальщик востребован в команде. Вы будете участвовать в командной разработке совместно с дизайнерами и другими творческими личностями</p>
                            </li>
                            <li class="webmaster-pluses__item">
                                <img  class="webmaster-pluses__img" src="/img/freelance.jpg" alt="Фриланс">
                                <div class="webmaster-pluses__title">Фриланс</div>
                                <p class="webmaster-pluses__text">Огромное количество фриланс бирж с одиночными заказами на версту размещено в интернете. На них можно найти и постоянных заказчиков в виде компаний и иметь регулируемый вами заработок, сидя дома</p>
                            </li>
                            <li class="webmaster-pluses__item">
                                <img  class="webmaster-pluses__img" src="/img/carear.jpg" alt="Профессиональный рост">
                                <div class="webmaster-pluses__title">Профессиональный рост</div>
                                <p class="webmaster-pluses__text">Работая с версткой, Вы несомненно изучите много новых технологий web-разработки, например направления frontend и backend, которые улучшат ваше мастерство и поднимет стоимость ваших трудов</p>
                            </li>
                        </ul>
                        <div class="salary">
                            <h3 class="salary__h">Зарплата веб-верстальщика</h3>
                            <ul class="salary__level">
                                <li class="salary__level-item" :class="salaryPointer[0]" @click="changeSalary(0)">Junior</li>
                                <li class="salary__level-item" :class="salaryPointer[1]" @click="changeSalary(1)">Middle</li>
                                <li class="salary__level-item" :class="salaryPointer[2]" @click="changeSalary(2)">Senior</li>
                            </ul>
                            <div class="salary__shower" :style="sallaryClass">{{salary}}</div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="course-features">
                <div class="container">
                    <h2 class="section-h2"><span class="section-h2__second-string">Особенности курса</span></h2>
                    <ul class="features-list">
                        <li class="features-list__item">
                            <h3 class="features-list__title">Индивидуальное обучение</h3>
                            <p class="features-list__text">Курс проходит онлайн, через Discord или Skype, с преподавателем, практикующимся в вёрстке сайтов. Нет готовых видеозаписей или занятий в группе. Всё в реальном времени индивидуально для Вас! Мы за качественное образование. При личном контакте - научиться гораздо проще!</p>
                        </li>
                        <li class="features-list__item">
                            <h3 class="features-list__title">Обучение работе в команде</h3>
                            <p class="features-list__text">Компаниям необходимы люди, имеющие опыт в командной разработке. Практикующий сотрудник в компании по созданию сайтов расскажет Вам о работе в команде и как происходит рабочий процесс с дизайнером и маркетологом.</p>
                        </li>
                        <li class="features-list__item">
                            <h3 class="features-list__title">Работы в портфолио</h3>
                            <p class="features-list__text">По окончанию обучения, у Вас будет несколько сайтов, которые Вы создали лично, благодаря нашему курсу. Все они могут быть использованы Вами для предоставления их в виде Вашего портфолио на фриланс-бирже или в Вашем резюме, если Вы хотите работать на компанию!</p>
                        </li>
                        <li class="features-list__item">
                            <h3 class="features-list__title">Консультации</h3>
                            <p class="features-list__text">Преподаватель, как практикующий специалист, расскажет Вам обо всех особенностях профессии HTML-верстальщика, как можно зарабатывать благодаря навыку вёрстки, как пройти собеседование и как работать в команде. И не забывайте, обо всем что Вас интересует, Вы сможете спросить лично во время курса!</p>
                        </li>
                    </ul>
                </div>
            </section>
            <section id="get-discount">
                <div class="container">
                    <h2 class="discount-h">Получите <br>консультацию по курсу</h2>
                    <form id="consult-form" method="POST" class="discount-form" @submit.prevent="() => {konsulForm()}">
                        <fieldset class="discount-form__fieldset">
                            <legend style="display:none;">Получить консультацию</legend>
                            <input class="discount-form__input" type="text" required name="name" placeholder="Имя">
                            <input class="discount-form__input" type="tel" required name="tel" placeholder="Телефон">
                            <input class="discount-form__input" type="email" required name="email" placeholder="Email">
                            <input class="discount-form__submit" type="submit" value="Отправить">
                        </fieldset>
                    </form>
                </div>
            </section>
            <section id="how-to-study">
                <div class="container">
                    <h2 class="section-h2"><span class="section-h2__top-str">Как будет проходить</span><span class="section-h2__second-string">Ваше обучение</span><span class="section-h2__sign">?</span></h2>
                    <ol class="study-list">
                        <li class="study-list__item">
                            <h3 class="study-list__h">Уроки 3 раза в неделю</h3>
                            <p class="study-list__text">В Пн Ср и Пт преподаватель будет рассказывать Вам о новой теме через трансляцию в Discord или Skype. Покажет где и как применяются знания. Даст дополнительные материалы и литературу по теме, проведет мини-тест и будет готов ответить на Ваши вопросы</p>
                        </li>
                        <li class="study-list__item">
                            <h3 class="study-list__h">Практическое задание</h3>
                            <p class="study-list__text">В ходе курса будет много практических заданий разной сложности. Они выдаются после каждого урока и проверяются отдельно. Консультацию по заданиям можно получить в конце урока, если возникнут вопросы во время выполнения - преподаватель всегда на связи</p>
                        </li>
                        <li class="study-list__item">
                            <h3 class="study-list__h">Работаете с наставником</h3>
                            <p class="study-list__text">Во время вашего обучения вы будете верстать крупные сайты по профессиональным макетам, работая с такими графическими инструментами как Photoshop и Figma. Преподаватель будет сопровождать и консультировать Вас на пути</p>
                        </li>
                        <li class="study-list__item">
                            <h3 class="study-list__h">Защищаете итоговую работу</h3>
                            <p class="study-list__text">Важным заданием курса является итоговая работа, в которой Вы примените все изученное в этом курсе, которая станет гордостью Вашего портфолио</p>
                        </li>
                    </ol>
                    <div class="study-plan">
                        <div class="study-plan__top">
                            <h2>План обучения</h2>
                            <p>Обучение разделенно на два больших модуля. С уроками этих модулей Вы можете ознакомиться здесь</p>
                        </div>
                        <div class="study-plan__list">
                            <ol class="study-plan__ol">
                                <li class="study-plan__ol-li" @click="studyplanTopFunc()" :class="studyplanTop">
                                    <span>1. Веб-вёрстка с нуля</span>
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
                                <li class="study-plan__ol-li" @click="studyplanBottomFunc()" :class="studyplanBottom">
                                    <span>2. Веб-вёрстка PRO</span>
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
            <section id="price">
                <div class="container">
                    <div class="price-card">
                        <div class="price-card__text">
                            <h3 class="price-card__h">Стоимость обучения</h3>
                            <span class="price-card__old">87&nbsp;500&nbsp;тг  | 15&nbsp;100&nbsp;руб за модуль</span> 
                            <div class="sale">Скидка 30%</div>
                            <h6 class="price-card__h6">Стоимость со скидкой за 1 модуль</h6>
                            <p class="price-card__new-price">61&nbsp;250&nbsp;тг  | 10&nbsp;550&nbsp;руб</p>
                            <h6 class="price-card__h6">Всего модулей: 2</h6>
                        </div>
                        <form class="price-card__form" action="#">
                            <fieldset class="discount-form__fieldset">
                                <span class="price-card__form-text">Обучение рассчитано в среднем на два месяца и состоит из двух модулей. Длительность зависит от Вашей успеваемости. Количество мест ограничено. Курс можно проходить помодульно</span>
                                <legend style="display:none;">Записаться</legend>
                                <div class="price-card__bait">
                                <span class="price-card__bait-text"> Осталось мест: <sapn class="price-card__bait-text--danger"> {{freePlaces}}</sapn></span>
                                <router-link v-if="freePlaces != 0" to="../registry" class="discount-form__submit">Записаться</router-link>
                                <router-link v-else to="../registry" class="discount-form__submit">Записаться на следующий набор</router-link>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </section>
        </main>
         <footer>
            <p>
                все права защищены © 2020
            </p>
            <p>
                +7 708 630 0760
            </p>
        </footer>
    </div>
</template>

<script>
import modalMessage from './modalMessage.vue';
import axios from 'axios';
import ajaxConf from '../config/ajax';
import freePlaces from '../config/freeplaces';

export default {
    components: {
        modalMessage
    },
    name: 'app',
    data() {
        return {
            freePlaces: freePlaces.count,
            isModalMessage: false,
            modalMessage: [
                "Ваша заявка успешно отправлена! Мы перезвоним Вам в течение дня.",
                "green",
                "✔"
            ],
            logoHeaderOpened: false,
            headerClassActive: '',
            navActived: '',
            studyplanTop: '',
            studyplanBottom: '',
            salaryPointer: ['salary__level-item--active', '', ''],
            // modal: {
            //     opened: true,
            //     elements: {
            //         onlineRegistration: {display: 'block'}
            //     }
            // }
        }
    },
    computed: {
        modalWrapper(){
            if (this.modal.opened === true) {
                return {display: 'block'};
            } else {
                return {display: 'none'};
            }
        },
        modalEl(){
            return  this.modal.elements;
        },
        sallaryClass(){
            if (this.salaryPointer[0] == 'salary__level-item--active') {return {textAlign: 'left',}} ;
            if (this.salaryPointer[1] == 'salary__level-item--active') {return {textAlign: 'center',}} ;
            if (this.salaryPointer[2] == 'salary__level-item--active') {return {textAlign: 'right',}} ;
        },
        salary() {
            if (this.salaryPointer[0] == 'salary__level-item--active') {return 'до 200 000 тг'} ;
            if (this.salaryPointer[1] == 'salary__level-item--active') {return '200 000 - 450 000 тг'} ;
            if (this.salaryPointer[2] == 'salary__level-item--active') {return 'от 450 000 тг'} ;
        },
    },
    methods: {
        closeModal() {
            this.modal.opened = false;
            this.modal.elements = {
                    onlineRegistration: {display: 'none'}
            }
        },
        openModal(n){
            this.modal.opened = true;
            this.modal.elements = {
                    onlineRegistration: {display: 'none'}
            }
            
            this.modal.elements[n] = {display: 'block'}
        },
        changeSalary(n){
            this.salaryPointer = ['','',''];
            this.salaryPointer[n] = 'salary__level-item--active'
        },
        studyplanTopFunc() {
            
            if (this.studyplanTop == '') {
                this.studyplanTop = 'active';
            } else {
                this.studyplanTop = '';
            };
        },
        studyplanBottomFunc() {
            
            if (this.studyplanBottom == '') {
                this.studyplanBottom = 'active';
            } else {
                this.studyplanBottom = '';
            };
        },
        closeMenu() {
            this.navActived = '';
            if (this.headerClassActive != 'active') {
                this.logoHeaderOpened = false;
            }
            
        },
        activeNav() {
            if (this.navActived == 'active') {
                this.navActived = '';
                if (this.headerClassActive != 'active') {
                    this.logoHeaderOpened = false;
                }

            } else {
                this.navActived = 'active';
                this.logoHeaderOpened = true;

            }
        },
        konsulForm() {
            const formData = new FormData(document.getElementById('consult-form'));
            // this.modalLoader = true;
            const btn = document.querySelector('input.discount-form__submit');
            console.log(btn);
            btn.setAttribute("disabled", "disabled");
            const context = this;
            setTimeout(()=> {
                axios.post(ajaxConf.action('sendkonsult'), formData)
                    .then(function(response) {
                        console.log(response.data);
                        // context.modalLoader = false;
                        context.isModalMessage = true;
                        setTimeout(()=>{
                            context.isModalMessage = false;
                            const inputs = document.querySelectorAll('.discount-form__input');
                            inputs.forEach(el => {
                                el.value = '';
                            });
                        }, 4000);
                    })
                    .catch(function(err) {
                        context.modalLoader = false;
                        // console.log(err);
                        alert('Ошибка сервера, повторите позже');
                    })
                    .finally(function() {
                        context.modalLoader = false;
                        btn.removeAttribute("disabled");
                    })
            }, 500)
        }
    },
    mounted: function (){
         axios.get('/api/freeplaces')
        .then(res => {
            this.freePlaces = freePlaces.max + freePlaces.count - res.data.count;
            if (this.freePlaces < 0) {
                this.freePlaces = 0;
            }
        });
        if (window.pageYOffset > 1) {
            this.headerClassActive = 'active';
            this.logoHeaderOpened = true;
        } else {
            this.headerClassActive = '';
            this.logoHeaderOpened = false;
        }
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 1) {
                this.headerClassActive = 'active';
                this.logoHeaderOpened = true;
            } else {
                this.headerClassActive = '';
                this.logoHeaderOpened = false;
            }
        });
    }
}
</script>