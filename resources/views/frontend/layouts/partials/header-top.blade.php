<div class="header__topbar bg__secondary">
    <div class="container-fluid">
        <div class="header__topbar--inner d-flex align-items-center justify-content-between">
            <div class="header__shipping">
                <p class="header__shipping--text text-white">Free shipping for orders over $59 !</p>
            </div>
            <div class="language__currency d-none d-lg-block">
                <ul class="d-flex align-items-center">
                    <li class="header__shipping--text text-white"><img class="header__shipping--text__icon" src="
                    {{ asset('assets/img/icon/bus.png') }} " alt="bus-icon"> Track Your Order</li>
                    <li class="language__currency--list">
                        <a class="language__switcher text-white" href="#">
                            <img class="language__switcher--icon__img" src="{{ asset('assets/img/icon/language-icon.png') }} "
                                 alt="currency">
                            <span>English</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="11.797" height="9.05" viewbox="0 0 9.797 6.05">
                                <path d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"></path>
                            </svg>
                        </a>
                        <div class="dropdown__language">
                            <ul>
                                <li class="language__items"><a class="language__text" href="#">France</a></li>
                                <li class="language__items"><a class="language__text" href="#">Russia</a></li>
                                <li class="language__items"><a class="language__text" href="#">Spanish</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="language__currency--list">
                        <a class="account__currency--link text-white" href="#">
                            <img src="{{ asset('assets/img/icon/usd-icon.png') }} " alt="currency">
                            <span>$ US Dollar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="11.797" height="9.05" viewbox="0 0 9.797 6.05">
                                <path d="M14.646,8.59,10.9,12.329,7.151,8.59,6,9.741l4.9,4.9,4.9-4.9Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"></path>
                            </svg>
                        </a>
                        <div class="dropdown__currency">
                            <ul>
                                <li class="currency__items"><a class="currency__text" href="#">CAD</a></li>
                                <li class="currency__items"><a class="currency__text" href="#">CNY</a></li>
                                <li class="currency__items"><a class="currency__text" href="#">EUR</a></li>
                                <li class="currency__items"><a class="currency__text" href="#">GBP</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
