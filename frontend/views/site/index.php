<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="building_img_container">
    <div class="building_img">
        <?= Html::img('uploads/test.png') ?>
    </div>
</div>
<div class="selection_wrapper">
    <div class="selection">
        <?php $form = ActiveForm::begin([
            'id' => 'selection_form'
        ]); ?>
            <?= $form->field($model, 'speciality_id')->dropDownList($specialities, ['prompt' => 'Спеціальність','style' => 'color: #fff; font-size: 20px;',])->label(false) ?>
            <?= $form->field($model, 'term')->dropDownList($terms, ['prompt' => 'Рік', 'style' => 'color: #fff; font-size: 20px;'])->label(false) ?>
            <span></span>
            <?= Html::submitButton('Знайти', ['class' => 'btn btn-primary search_button']) ?>

        <?php ActiveForm::end();?>
    </div>
</div>
<div class="greetings-wrapper">
    <div class="greetings">
        <div class="greetings_explanation">
            <span class="greetings_explanation_welcome">
                Ласкаво просимо
            </span>
            <span class="greetings_explanation_pointer">
                Якщо виникли складнощі зі знаходженням рейтину чи Авторизаціею на сайті
Нижче <br>вказані короткі інтрукції.
            </span>
            <div class="greetings_explanation_container">
                <div class="greetings_explanation_user">
                    <span class="greetings_explanation_user_title">
                        Для Студентів
                    </span>
                    <span class="greetings_explanation_user_text">
                        Щоб вибрати рейтинг, що вас цікавить, Вам необхідно навести спочатку на
                        <span class="custom_span_speciality">“Спеціальність”</span>
                        і вибрати необхідну спеціальність, потім виконати аналогічні дії щодо
                        <span class="custom_span_year">“Рік”</span>
                        , та натиснути
                        <span class="custom_span_show">“Показати”</span>
                        .
                    </span>

                </div>
                <div class="greetings_explanation_admin">
                    <span class="greetings_explanation_admin_title">
                        Для Викладачів
                    </span>
                    <span class="greetings_explanation_admin_text">
                        Щоб отримати можливість редагувати рейтинг, необхідно в полі
                        <span class="custom_span_speciality">“Електронна пошта”</span>
                        ввести надану Вам електронну адресу, а в полі
                        <span class="custom_span_speciality">“Пароль”</span> - пароль, та натиснути
                        <span class="custom_span_speciality">“Увійти”.</span>
                    </span>
                </div>
            </div>

        </div>

        <div class="greetings_authorization">

                    <span class="greetings_authorization_title">
                        Авторизація
                    </span>

                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'login-form-class']); ?>

                    <?= $form->field($loginModel, 'username')->textInput(['autofocus' => true, 'id' => 'username_input']) ?>

                    <?= $form->field($loginModel, 'password')->passwordInput(['id' => 'password_input']) ?>

                    <divs>
                        <?= Html::submitButton('Увійти', ['class' => 'btn btn-primary login_button', 'name' => 'login-button']) ?>
                    </divs>

                    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
