<template>
    <div class="modal-wrapper">
        <section id="online-registration" class="modal-section" style="display: block">
            <div class="container">
                <a href="#" class="back-link" @click="closeModal()"><span></span></a>
                <h2 class="modal-section__h">Записаться на курс</h2>
                <p class="modal-section__p">Заполните форму, чтобы записаться на курс. После завершения записи вам позвонит наш менеджер, определит вам преподавателя и соорентирует вас по времени проведения уроков. Указывайте пожалуйста реальные данные. Если у вас есть вопросы по курсу, то можете <a href="#">заказать звонок</a></p>
                <form action="#" class="register-from">
                    <label class="register-from__label">
                        <p class="register-from__p">Ваше ФИО</p>
                        <input class="register-from__input-text" type="text" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш Email</p>
                        <input class="register-from__input-text" type="text" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <p class="register-from__p">Ваш телефон</p>
                        <input class="register-from__input-text" type="text" placeholder="">
                    </label>
                    <label class="register-from__label">
                        <span class="register-from__span">Обучение проходит три раза в неделю, в понедельник, в среду и в пятницу. Урок длится 1 час 30 минут.</span>
                        <p class="register-from__p">Выберите удобное для вас время суток</p>
                        <select class="register-from__select" name="" id="">
                            <option value="">Утро</option>
                            <option value="">Обед</option>
                            <option value="">Вечер</option>
                        </select>
                    </label>
                    <input class="register-from__submit" type="submit" value="Далее">
                </form>
            </div>
        </section>
    </div>
</template>