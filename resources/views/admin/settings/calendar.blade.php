<style>

    p.small {
        text-align: center;
        color: #7f8c8d;
        background: #fff;
        max-width: 768px;
        padding: 25px;
        margin: auto;
    }

    #grp {
        display: table;
        max-width: 768px;
        width: 100%;
        height: 50%;
        margin: auto;
        background: #fff;
    }

    .col-half {
        text-align: center;
        padding: 5%;
    }

    #wrapper {
        width: 100%;
        text-align: center;
        font-family: sans-serif;
    }
    #wrapper .main-calendar {
        display: inline-block;
        position: relative;
        background: #16a085;
        background: #16a085;
    }
    #wrapper .main-calendar h3 {
        font-size: 18px;
        box-sizing: border-box;
        font-weight: 500;
        margin: 5px 0;
        background: #95a5a6;
        background: rgba(255, 255, 255, 0.1);
    }
    #wrapper .main-calendar p {
        font-size: 15px;
        margin: 0;
        padding: 0;
        text-align: left;
    }
    #wrapper .main-calendar .spacer {
        padding: 15px;
    }
    #wrapper .main-calendar .calendar-head {
        display: inline-block;
        box-sizing: border-box;
        width: 100%;
        padding: 25px;
        background: #1abc9c;
        color: #fff;
        font-size: 21px;
    }
    #wrapper .main-calendar ul {
        list-style-type: none;
        padding: 0;
        width: 200px;
        margin: 0 auto;
    }
    #wrapper .main-calendar li {
        display: inline-block;
        opacity: 0.1;
        width: 25px;
        margin: 5px;
        height: 25px;
        color: #fff;
        line-height: 1.6;
        background: #1abc9c;
        background: rgba(26, 188, 156, 0.5);
        animation: fadeIn 0.55s ease;
        animation-fill-mode: forwards;
        cursor: pointer;
    }
    #wrapper .main-calendar li:not(.note) {
        border-radius: 0%;
        background: transparent;
    }
    #wrapper .main-calendar li:active .hidden, #wrapper .main-calendar li:focus .hidden, #wrapper .main-calendar li:hover .hidden {
        display: inline-block;
        visibility: visible;
        opacity: 1;
        animation: showNote 0.55s ease;
        animation-fill-mode: forwards;
    }
    #wrapper .main-calendar li .hidden {
        display: none;
        box-sizing: border-box;
        visibility: hidden;
        opacity: 0;
        padding: 15px;
        width: 100%;
        position: absolute;
        left: 103%;
        top: 0;
        color: #fff;
        background: #3498db;
        background: #3498db;
        cursor: auto;
        transition: 0.55s all ease;
    }
    @media (max-width: 768px) {
        #wrapper .main-calendar li .hidden {
            top: 103%;
            left: 0;
        }
    }

    ul li:nth-child(1) {
        animation-delay: 0s !important;
    }
    ul li:nth-child(1):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(2) {
        animation-delay: 0.11s !important;
    }
    ul li:nth-child(2):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(3) {
        animation-delay: 0.22s !important;
    }
    ul li:nth-child(3):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(4) {
        animation-delay: 0.33s !important;
    }
    ul li:nth-child(4):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(5) {
        animation-delay: 0.44s !important;
    }
    ul li:nth-child(5):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(6) {
        animation-delay: 0.55s !important;
    }
    ul li:nth-child(6):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(7) {
        animation-delay: 0.66s !important;
    }
    ul li:nth-child(7):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(8) {
        animation-delay: 0.77s !important;
    }
    ul li:nth-child(8):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(9) {
        animation-delay: 0.88s !important;
    }
    ul li:nth-child(9):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(10) {
        animation-delay: 0.99s !important;
    }
    ul li:nth-child(10):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(11) {
        animation-delay: 1.1s !important;
    }
    ul li:nth-child(11):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(12) {
        animation-delay: 1.21s !important;
    }
    ul li:nth-child(12):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(13) {
        animation-delay: 1.32s !important;
    }
    ul li:nth-child(13):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(14) {
        animation-delay: 1.43s !important;
    }
    ul li:nth-child(14):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(15) {
        animation-delay: 1.54s !important;
    }
    ul li:nth-child(15):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(16) {
        animation-delay: 1.65s !important;
    }
    ul li:nth-child(16):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(17) {
        animation-delay: 1.76s !important;
    }
    ul li:nth-child(17):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(18) {
        animation-delay: 1.87s !important;
    }
    ul li:nth-child(18):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(19) {
        animation-delay: 1.98s !important;
    }
    ul li:nth-child(19):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(20) {
        animation-delay: 2.09s !important;
    }
    ul li:nth-child(20):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(21) {
        animation-delay: 2.2s !important;
    }
    ul li:nth-child(21):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(22) {
        animation-delay: 2.31s !important;
    }
    ul li:nth-child(22):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(23) {
        animation-delay: 2.42s !important;
    }
    ul li:nth-child(23):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(24) {
        animation-delay: 2.53s !important;
    }
    ul li:nth-child(24):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(25) {
        animation-delay: 2.64s !important;
    }
    ul li:nth-child(25):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(26) {
        animation-delay: 2.75s !important;
    }
    ul li:nth-child(26):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(27) {
        animation-delay: 2.86s !important;
    }
    ul li:nth-child(27):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(28) {
        animation-delay: 2.97s !important;
    }
    ul li:nth-child(28):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(29) {
        animation-delay: 3.08s !important;
    }
    ul li:nth-child(29):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(30) {
        animation-delay: 3.19s !important;
    }
    ul li:nth-child(30):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    ul li:nth-child(31) {
        animation-delay: 3.3s !important;
    }
    ul li:nth-child(31):before {
        display: inline-block;
        font-size: 14px;
        line-height: 1.5;
        color: #fff;
        position: relative;
        width: 100%;
        height: 100%;
    }

    @keyframes fadeIn {
        from {
            opacity: 0.5;
        }
        to {
            opacity: 1;
        }
    }
    @keyframes showNote {
        0% {
            display: none;
            visibility: hidden;
            opacity: 0;
        }
        100% {
            display: inline-block;
            visibility: visible;
            opacity: 1;
        }
    }

</style>
<h1>Generated Calendar</h1>
<p class="small">Select the days that will not be checkin dates</p>
<div id="grp">
    <div class="col-half">
        <div id="wrapper">
            <div class="main-calendar">
                <div class="calendar-head">January</div>
                <div class="spacer">
                    <ul>
                        <li class="note">1
                            <div class="hidden">
                                <h3>11:00 PM</h3>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                                <h3>01:00 PM</h3>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                        </li>
                        <li class="note">2
                            <div class="hidden">
                                <h3>12:00 PM</h3>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                        </li>
                        <li>3</li>
                        <li>4</li>
                        <li>5</li>
                        <li>6</li>
                        <li>7</li>
                        <li class="note">8
                            <div class="hidden">
                                <h3>12:00 PM</h3>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                        </li>
                        <li>9</li>
                        <li>10</li>
                        <li>11</li>
                        <li>12</li>
                        <li>13</li>
                        <li>14</li>
                        <li>15</li>
                        <li>16</li>
                        <li>17</li>
                        <li>18</li>
                        <li class="note">19
                            <div class="hidden">
                                <h3>11:00 PM</h3>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                        </li>
                        <li>20</li>
                        <li>21</li>
                        <li>22</li>
                        <li>23</li>
                        <li>24</li>
                        <li>25</li>
                        <li class="note">26
                            <div class="hidden">
                                <h3>07:00 PM</h3>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                        </li>
                        <li>27</li>
                        <li>28</li>
                        <li>29</li>
                        <li>30</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="submit" class="btn btn-lg btn-success" value="Update Calendar">