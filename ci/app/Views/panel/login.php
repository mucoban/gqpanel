<body class="<?=isset($login) ? "-loginPage" : "" ?>">
<div class="logpag">
    <div class="logpag__box">
        <form class="logpag__boxForm" onsubmit="return fova_login(this)" method="post"
              action="panel/login/attempt"
              data-mode="">
             <div class="logpag__logoText"><?=_dp("Admin Panel")?></div>
            <input type="text" class="logpag__itext" name="uname" placeholder="<?=_dp("Kullanıcı adı")?>"><br>
            <input type="password" class="logpag__itext" name="pass" placeholder="<?=_dp("Şifre")?>"><br>
            <button class="logpag__submit">
                <div class="prelO">
                    <div class="prel">
                        <div class="lds-ring">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <span class="logpag__submitText"><?=_dp("Giriş")?></span>
            </button>
            <div class="cuscheck">
                <input type="checkbox" class="cuscheck__input">
                <div class="cuscheck__sq">
                    <div class="cuscheck__check"></div>
                </div>
                <div class="cuscheck__label"><?=_dp("Beni hatırla")?></div>
            </div>
        </form>
    </div>
</div>

<div class="flamsg js-flamsg" data-type="error" data-mode="0">
    <div class="flamsg__box">
        <svg class="flamsg__boxSvg -error" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/></svg>
        <div class="flamsg__boxText js-text">
            Kullanıcı adı veya şifre yanlış
        </div>
    </div>
</div>