<style>
    body {
        background: linear-gradient(253deg, #29d8c5, #98c1f1, #4484ed);
        background-size: 300% 300%;
        -webkit-animation: Background 25s ease infinite;
        -moz-animation: Background 25s ease infinite;
        animation: Background 25s ease infinite;

        overflow-y: hidden;
    }

    @-webkit-keyframes Background {
        0% {
            background-position: 0% 50%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0% 50%
        }
    }

    @-moz-keyframes Background {
        0% {
            background-position: 0% 50%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0% 50%
        }
    }

    @keyframes Background {
        0% {
            background-position: 0% 50%
        }
        50% {
            background-position: 100% 50%
        }
        100% {
            background-position: 0% 50%
        }
    }

    .full-screen {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: url(https://i.imgur.com/wCG2csZ.png);
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 100%;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        /* works with row or column */

        flex-direction: column;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        text-align: center;
    }

    h1 {
        color: #fff;
        font-family: 'Open Sans', sans-serif;
        font-weight: 800;
        font-size: 4em;
        letter-spacing: -2px;
        text-align: center;
        text-shadow: 1px 2px 1px rgb(8, 7, 7);
    }

    h3 {
        color: #7DF9FF;
        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
        font-size: 2em;
        letter-spacing: -2px;
        text-align: center;
        text-shadow: 1px 2px 1px rgb(8, 7, 7);
    }

    .button-line {
        font-family: 'Open Sans', sans-serif;
        text-transform: uppercase;
        letter-spacing: 2px;
        background: transparent;
        border: 1px solid #f9fbfb;
        border-radius: 10px;
        color: #7DF9FF;
        text-align: center;
        font-size: 1.4em;
        opacity: .8;
        padding: 20px 40px;
        text-decoration: none;
        transition: all .5s ease;
        margin: 0 auto;
        width: 100px;
        text-shadow: 1px 2px 1px rgb(8, 7, 7);
    }

    .button-line:hover {
        opacity: 1;
    }
</style>
<div class="full-screen">
    <div>
        <h1>Dream Pay</h1>
        <h3>Admin Dashboard</h3>
        <br>
        @auth
            <a href="{{ url('/dashboards') }}"
               class="button-line">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="button-line">Login</a>
        @endauth
    </div>
</div>
