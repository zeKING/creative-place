<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin panel "IT SOLUTION GROUP"</title>
    <meta name="author" content="IT-SG"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= admin_url() ?>app-assets/images/logo/it-sg-logo.png"/>
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/newlogin/css/reset.css">
    <link rel='stylesheet prefetch'
          href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <!--<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'> -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/admin/newlogin/css/style.css">
    <script type="text/javascript" src="<?= base_url() ?>assets/admin/newlogin/js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/newlogin/js/index.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/public/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
</head>

<body>

<style>

    .alert {
        padding: 10px;
        text-align: center;
        color: red;
        margin-left: 55px;
        margin-right: 55px;
        font-size: 18px;
    }

    #password:-webkit-autofill, #username:-webkit-autofill {
        height: 25px !important;
        margin-top: 15px;
        background-color: transparent !important;
    }
</style>
<script>

    $(window).resize();
</script>
<div class="container__1">
    <div class="forms__container">
        <div class="signin__signup">
            <?= form_open($link) ?>
            <h2 class="title__1">ВХОД В ПАНЕЛЬ IT-SG CMS</h2>
            <?= msg() ?>
            <div class="input__field__login">
                <i class="fa fa-user"></i>
                <input type="text" id="username" name="username" required="required" autocomplete="off"
                       placeholder="Логин">
            </div>

            <div class="input__field__login">
                <i class="fa fa-lock"></i>
                <input type="password" id="password" name="password" required="required" autocomplete="off"
                       placeholder="Пароль">
            </div>
            <input type="submit" value="Вход в систему" class="btn-main">


            </form>

        </div>
    </div>

    <div class="panels__container">
        <div class="panel left__panel">
            <div class="content">
                <h3 class="white__title">Добро пожаловать</h3>
                <p>
                    в панель администратора
                </p>
                <span>IT SOLUTION GROUP</span>
                <span>&copy; <?= date('Y') ?>. Все права защищены.</span>

            </div>
            <img src="<?= base_url() ?>assets/admin/img/photo-admin.png" class="image-T" alt="">
        </div>
    </div>
</div>

<style>
    <!--
    LOGIN

    /
    REGISTATION STYLE END

    -->
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    =
    *

    /

    .btn__custome__2 {
        color: #ffffff;
        background: #48455a;
    }

    .btn__custome__2:hover {
        color: #ffffff;
        background: #05af4f;
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px);
        -webkit-box-shadow: 0px 25px 60px 0px rgba(0, 0, 0, 0.1);
        box-shadow: 0px 25px 60px 0px rgba(0, 0, 0, 0.1);
    }

    .container__1 {
        position: relative;
        width: 100%;
        background-color: #fff;
        min-height: 100vh;
        overflow: hidden;
        z-index: 1;
    }

    .forms__container {
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .btn-main {
        background: #11c3cb;
        padding: 5px 30px;
        border-radius: 20px;
        transition: .3s;
        text-transform: uppercase;
        color: white;
        font-weight: 600;
        border: none;
        cursor: pointer;
        height: 40px;
        margin-top: 10px;
    }

    .btn-main:hover {
        border: 1px #11c3cb solid;
        color: #11c3cb;
        background-color: white;
    }

    .signin__signup {
        position: absolute;
        top: 50%;
        transform: translate(-50%, -50%);
        left: 75%;
        width: 50%;
        transition: 1s 0.7s ease-in-out;
        display: grid;
        grid-template-columns: 1fr;
        z-index: 5;
    }

    form {
        /* display: flex; */
        align-items: center;
        justify-content: center;
        text-align: center;
        flex-direction: column;
        /* padding: 0rem 5rem; */
        transition: all 0.2s 0.7s;
        /* overflow: hidden; */
        grid-column: 1 / 2;
        grid-row: 1 / 2;
    }

    form.sign__up__form {
        opacity: 0;
        z-index: 1;
        display: flex;
    }

    .signin__signup form {
        z-index: 2;
        display: flex;
    }

    .title__1 {
        font-size: 2.2rem;
        color: #00757a;
        margin-bottom: 10px;
    }

    .input__field__login {
        max-width: 380px;
        width: 100%;
        background-color: #e0e0e059;
        margin: 10px 0;
        height: 55px;
        border-radius: 55px;
        display: grid;
        grid-template-columns: 15% 85%;
        padding: 0 0.4rem;
        position: relative;
    }

    .input__field__login i {
        text-align: center;
        line-height: 55px;
        color: #11c3cb;
        transition: 0.5s;
        font-size: 1.1rem;
    }

    .input__field__login input {
        background: none;
        outline: none;
        border: none;
        line-height: 1;
        font-weight: 600;
        font-size: 0.9rem;
        color: #3e3e3e;
    }

    .input__field__login input::placeholder {
        color: #aaa;
        font-weight: 500;
    }

    .social__text {
        padding: 0.7rem 0;
        font-size: 1rem;
    }

    .social__media {
        display: flex;
        justify-content: center;
    }

    .social-icon {
        height: 46px;
        width: 46px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 0.45rem;
        color: #333;
        border-radius: 50%;
        border: 1px solid #333;
        text-decoration: none;
        font-size: 1.1rem;
        transition: 0.3s;
    }

    .social-icon:hover {
        color: #4481eb;
        border-color: #4481eb;
    }

    .white__title {
        color: #fff;
    }

    .panels__container {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .container__1:before {
        content: "";
        position: absolute;
        height: 2000px;
        width: 2000px;
        top: -10%;
        right: 48%;
        transform: translateY(-50%);
        background-image: linear-gradient(-45deg, #02afb7 0%, #11c3cb 100%);
        transition: 1.8s ease-in-out;
        border-radius: 50%;
        z-index: 6;
    }

    .image-T {
        width: 100%;
        transition: transform 1.1s ease-in-out;
        transition-delay: 0.4s;
    }

    .panel {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-around;
        text-align: center;
        z-index: 6;
    }

    .left__panel {
        pointer-events: all;
        padding: 3rem 17% 2rem 12%;
    }

    .right__panel {
        pointer-events: none;
        padding: 3rem 12% 2rem 17%;
    }

    .panel .content {
        color: #fff;
        transition: transform 0.9s ease-in-out;
        transition-delay: 0.6s;
    }

    .panel h3 {
        line-height: 1;
        font-size: 2rem;
    }

    .panel p {
        font-size: 1.2rem;
        padding: 0.7rem 0;
    }


    /* .btn.transparent {
                        margin: 0;
                        background: none;
                        border: 2px solid #fff;
                        width: 130px;
                        height: 41px;
                        font-weight: 600;
                        font-size: 0.8rem;
                        }
                        */

    .right__panel .image-T,
    .right__panel .content {
        transform: translateX(800px);
    }


    /* ANIMATION */

    .container__1.sign-up-mode:before {
        transform: translate(100%, -50%);
        right: 52%;
    }

    .container__1.sign-up-mode .left__panel .image-T,
    .container__1.sign-up-mode .left__panel .content {
        transform: translateX(-800px);
    }

    .container__1.sign-up-mode .signin__signup {
        left: 25%;
    }

    .container__1.sign-up-mode form.sign__up__form {
        opacity: 1;
        z-index: 2;
    }

    .container__1.sign-up-mode form.sign__in__form {
        opacity: 0;
        z-index: 1;
    }

    .container__1.sign-up-mode .right__panel .image-T,
    .container__1.sign-up-mode .right__panel .content {
        transform: translateX(0%);
    }

    .container__1.sign-up-mode .left__panel {
        pointer-events: none;
    }

    .container__1.sign-up-mode .right__panel {
        pointer-events: all;
    }

    @media (max-width: 870px) {
        .container__1 {
            /* min-height: 800px; */
            height: 100vh;
        }

        .signin__signup {
            width: 100%;
            top: 75%;
            transform: translate(-50%, -100%);
            transition: 1s 0.8s ease-in-out;
        }

        .signin__signup,
        .container__1.sign-up-mode .signin__signup {
            left: 50%;
        }

        .panels__container {
            grid-template-columns: 1fr;
            grid-template-rows: 1fr 2fr 1fr;
        }

        .panel {
            flex-direction: row;
            justify-content: space-around;
            align-items: center;
            padding: 1.5rem 8%;
            grid-column: 1 / 2;
        }

        .right__panel {
            grid-row: 3 / 4;
        }

        .left__panel {
            grid-row: 1 / 2;
        }

        .image-T {
            width: 200px;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.6s;
        }

        .panel .content {
            padding-right: 15%;
            transition: transform 0.9s ease-in-out;
            transition-delay: 0.8s;
        }

        .panel h3 {
            font-size: 1.2rem;
        }

        .panel p {
            font-size: 0.7rem;
            padding: 0.5rem 0;
        }

        /* .btn.transparent {
                          width: 110px;
                          height: 35px;
                          font-size: 0.7rem;
                        } */
        .container__1:before {
            width: 1500px;
            height: 1500px;
            transform: translateX(-50%);
            left: 30%;
            bottom: 68%;
            right: initial;
            top: initial;
            transition: 2s ease-in-out;
        }

        .container__1.sign-up-mode:before {
            transform: translate(-50%, 100%);
            bottom: 32%;
            right: initial;
        }

        .container__1.sign-up-mode .left__panel .image-T,
        .container__1.sign-up-mode .left__panel .content {
            transform: translateY(-300px);
        }

        .container__1.sign-up-mode .right__panel .image-T,
        .container__1.sign-up-mode .right__panel .content {
            transform: translateY(0px);
        }

        .right__panel .image-T,
        .right__panel .content {
            transform: translateY(300px);
        }

        .container__1.sign-up-mode .signin__signup {
            top: 5%;
            transform: translate(-50%, 0);
        }
    }

    @media (max-width: 570px) {
        /*.image-T {*/
        /*    display: none;*/
        /*}*/

        .panel .content {
            padding: 0.5rem 1rem;
        }

        .container__1 {
            padding: 1.5rem;
        }

        .container__1:before {
            bottom: 72%;
            left: 50%;
        }

        .container__1.sign-up-mode:before {
            bottom: 28%;
            left: 50%;
        }
        .panel.left__panel{
            flex-direction: column;
        }
    }

    .animate__1 {
        position: absolute;
        top: 35%;
        left: 25%;
        display: flex;
        -webkit-animation: anti-clockwise 30s linear infinite normal;
        animation: anti-clockwise 30s linear infinite normal;
        align-items: center;
        justify-content: center;
    }

    .animation__1 {
        background: rgba(6, 201, 16, 0.863);
        width: 15px;
        height: 15px;
        opacity: .5;
        animation: rotating 15s linear infinite normal;
    }

    @keyframes anti-clockwise {
        0% {
            -webkit-transform: rotate(0) translate(165px) rotate(0);
            transform: rotate(0) translate(165px) rotate(0);
        }
        100% {
            -webkit-transform: rotate(-360deg) translate(165px) rotate(360deg);
            transform: rotate(-360deg) translate(165px) rotate(360deg);
        }
    }

    @keyframes rotating {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }
        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
    }

    .animate__2 {
        top: 75%;
        left: 25%;
        position: absolute;
        animation: rotating-diagonal 15s linear infinite alternate;
    }

    @keyframes rotating-diagonal {
        0% {
            -webkit-transform: translate(-300px, 150px) rotate(0);
            transform: translate(-300px, 150px) rotate(0);
        }
        100% {
            -webkit-transform: translate(300px, -150px) rotate(180deg);
            transform: translate(300px, -150px) rotate(180deg);
        }
    }

    .animation__2 {
        border-radius: 50%;
        height: 20px;
        width: 20px;
        border: 5px solid #ff6f61;
    }

    *,
    ::after,
    ::before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    @keyframes anti-clockwise {
        0% {
            -webkit-transform: rotate(0) translate(165px) rotate(0);
            transform: rotate(0) translate(165px) rotate(0);
        }
        100% {
            -webkit-transform: rotate(-360deg) translate(165px) rotate(360deg);
            transform: rotate(-360deg) translate(165px) rotate(360deg);
        }
    }

    .animate__3 {
        top: 50%;
        left: 50%;
        position: absolute;
        -webkit-animation: anti-clockwise 30s linear infinite normal;
        animation: anti-clockwise 30s linear infinite normal;
    }

    @keyframes anti-clockwise {
        0% {
            -webkit-transform: rotate(0) translate(165px) rotate(0);
            transform: rotate(0) translate(165px) rotate(0);
        }
        100% {
            -webkit-transform: rotate(-360deg) translate(165px) rotate(360deg);
            transform: rotate(-360deg) translate(165px) rotate(360deg);
        }
    }

    .animate__3 div::before {
        -webkit-transform: rotate(-135deg) skewX(-45deg) scale(1.414, .707) translate(0, -50%);
        transform: rotate(-135deg) skewX(-45deg) scale(1.414, .707) translate(0, -50%);
        width: 15px;
        height: 15px;
        border-top-right-radius: 30%;
        content: '';
        position: absolute;
        background-color: inherit;
    }

    .animate__3 div::after {
        -webkit-transform: rotate(135deg) skewY(-45deg) scale(.707, 1.414) translate(50%);
        transform: rotate(135deg) skewY(-45deg) scale(.707, 1.414) translate(50%);
        width: 15px;
        height: 15px;
        border-top-right-radius: 30%;
        content: '';
        position: absolute;
        background-color: inherit;
    }

    .animation__3 {
        width: 15px;
        height: 15px;
        border-top-right-radius: 30%;
        opacity: 0.5;
        position: relative;
        background-color: #2f19b3;
        text-align: left;
        -webkit-transform: rotate(-60deg) skewX(-30deg) scale(1, .866);
        transform: rotate(-60deg) skewX(-30deg) scale(1, .866);
        -webkit-animation: rotating 15s linear infinite normal;
        animation: rotating 15s linear infinite normal;
        -webkit-transform: rotate(-135deg) skewX(-45deg) scale(1.414, .707) translate(0, -50%);
        transform: rotate(-135deg) skewX(-45deg) scale(1.414, .707) translate(0, -50%);
    }

    @keyframes rotating {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }
        100% {
            -webkit-transform: rotate(-360deg);
            transform: rotate(-360deg);
        }
    }

    .animate__4 {
        position: absolute;
        top: 30%;
        left: 50%;
        display: flex;
        -webkit-animation: anti-clockwise__4 30s linear infinite normal;
        animation: anti-clockwise__4 30s linear infinite normal;
        align-items: center;
        justify-content: center;
    }

    .animation__4 {
        background: rgb(3 185 97);
        width: 15px;
        height: 15px;
        border-radius: 50%;
        opacity: .5;
        animation: rotating__4 15s linear infinite normal;
    }

    @keyframes anti-clockwise__4 {
        0% {
            -webkit-transform: rotate(0) translate(165px) rotate(0);
            transform: rotate(0) translate(165px) rotate(0);
        }
        100% {
            -webkit-transform: rotate(360deg) translate(165px) rotate(360deg);
            transform: rotate(360deg) translate(165px) rotate(360deg);
        }
    }

    @keyframes rotating__4 {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .animate__5 {
        position: absolute;
        top: 10%;
        left: 77%;
        display: flex;
        -webkit-animation: anti-clockwise__4 30s linear infinite normal;
        animation: anti-clockwise__4 30s linear infinite normal;
        align-items: center;
        justify-content: center;
    }

    .animation__5 {
        background: rgb(222 26 78);
        width: 20px;
        height: 20px;
        border-radius: 18%;
        opacity: .5;
        animation: rotating__4 15s linear infinite normal;
    }

    @keyframes anti-clockwise__4 {
        0% {
            -webkit-transform: rotate(0) translate(165px) rotate(0);
            transform: rotate(0) translate(165px) rotate(0);
        }
        100% {
            -webkit-transform: rotate(360deg) translate(165px) rotate(360deg);
            transform: rotate(360deg) translate(165px) rotate(360deg);
        }
    }

    @keyframes rotating__4 {
        0% {
            -webkit-transform: rotate(0);
            transform: rotate(0);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .navbar__link:before {
        content: "";
        position: absolute;
        height: 2px;
        width: 0%;
        background-color: #03b961;
        left: 2px;
        -webkit-transition: 0.3s all ease-in-out;
        -o-transition: 0.3s all ease-in-out;
        transition: 0.3s all ease-in-out;
        bottom: 0;
    }

    .navbar__link:hover:before {
        width: 100%
    }

    .social__icon:hover {
        color: #ffffff;
        background: var(--second-color);
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px);
        -webkit-box-shadow: 0px 5px 15px 0px rgb(72 69 90 / 30%);
        box-shadow: 0px 5px 15px 0px rgb(72 69 90 / 30%);
    }

    .icon {
        width: 48px;
        height: 48px;
        line-height: 48px;
        text-align: center;
        border-radius: 50%;
        font-size: 16px;
        text-shadow: 2px 3px 8px rgb(0 0 0 / 10%);
        -webkit-box-shadow: 0px 15px 30px 0px rgb(0 0 0 / 25%);
        box-shadow: 0px 15px 30px 0px rgb(0 0 0 / 25%);
        transition: all linear .3s;
        -webkit-transition: all linear .3s;
        -moz-transition: all linear .3s;
        -ms-transition: all linear .3s;
        -o-transition: all linear .3s;
    }

    ul.banner__social {
        display: flex;
    }

    ul.banner__social li {
        margin: 4px;
    }

    .social__icon {
        color: #ffffff;
        background: var(--main-color);
    }

    h2.title {
        color: var(--second-color);
    }
</style>
</body>
</html>