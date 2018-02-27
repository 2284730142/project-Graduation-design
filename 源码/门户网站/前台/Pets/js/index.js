/**
 * Created by Administrator on 2017/11/2.
 */
$(function () {

    /*
     * 先获取sessionstorage
     * */
    if (sessionStorage.getItem('user')) {
        var a = JSON.parse(sessionStorage.getItem('user'));
        $('#notLogin').css('display', 'none');
        $('#yesLogin').css('display', 'block');
    } else {
        $('#notLogin').css('display', 'block');
        $('#yesLogin').css('display', 'none');
    }

    /*
     * 首页导航栏鼠标悬停
     * */
    var $item = $('.index-container>div');

    $item.bind('mouseover', function (e) {
        var $self = $(this);
        $self.find('ul').slideDown(500);
    });

    $item.bind('mouseleave', function (e) {
        var $self = $(this);
        $self.find('ul').slideUp(0).stop();
    });
    //个人中心
    var $item = $('#yesLogin');

    $item.bind('mouseover', function (e) {
        var $self = $(this);
        $('#personCenterIcon')[0].className = "icon-up-open";
        $self.find('div').slideDown(0);
    });

    $item.bind('mouseleave', function (e) {
        var $self = $(this);
        $('#personCenterIcon')[0].className = "icon-down-open";
        $self.find('div').slideUp(0);
    });
    //登录&注册
    var $register = $('#register');
    var $cancel = $('#cancel');
    var $dialogContainer = $('#dialogContainer');
    var $login = $('#login');
    var $dialogContainer2 = $('#dialogContainer2');
    var $cancel2 = $('#cancel2');

    $cancel.bind('click', function () {
        $dialogContainer.css("display", "none");
    });
    $register.bind('click', function () {
        $dialogContainer.css("display", "block");
    });
    $login.bind('click', function () {
        $dialogContainer2.css("display", "block");
    });
    $cancel2.bind('click', function () {
        $dialogContainer2.css("display", "none");
    });

    /*
     * 验证码部分
     * */
    var canvas = document.getElementById('canvas');
    var cxt = canvas.getContext('2d');
    var text = randomString();
    drawString(text);

    function randomString() {
        var code = '';
        var source = '012345789ascdefgqwrtyuioplkjghmnvczx';

        for (var i = 0; i < 4; i++) {
            var index = Math.floor(Math.random() * source.length);
            code = code + source.charAt(index);
        }
        return code;
    }

    function drawString(code) {
        sessionStorage.setItem('Code', code);
        cxt.clearRect(0, 0, canvas.width, canvas.height);
        cxt.fillStyle = '#ccc';
        cxt.font = '30px 黑体';
        cxt.textBaseline = 'top';
        for (var i = 0; i < code.length; i++) {
            var r = randomNumber(0, 255);
            var g = randomNumber(0, 255);
            var b = randomNumber(0, 255);
            var h = randomNumber(0, canvas.height - 30);
            cxt.fillStyle = 'rgb(' + r + ',' + g + ',' + b + ')';
            cxt.fillText(code.charAt(i), 10 + i * 18, h);
        }
        for (var i = 0; i < 8; i++) {
            var x1 = randomNumber(0, canvas.width);
            var y1 = randomNumber(0, canvas.height);

            var x2 = randomNumber(0, canvas.width);
            var y2 = randomNumber(0, canvas.height);

            cxt.strokeStyle = '#ddd';
            cxt.beginPath();
            cxt.moveTo(x1, y1);
            cxt.lineTo(x2, y2);
            cxt.closePath();
            cxt.stroke();
        }
    }

    canvas.onclick = function (e) {
        var code = randomString();
        text = code;
        drawString(code);
    };

    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    //注册
    $("#model-register").click(function () {
        var userName = $('#nickName').val();
        var password = $('#userPwd').val();
        var phone = $('#phone').val();
        var msg = "";
        if ($.trim(userName) == "") {
            msg = "用户名不能为空！";
        } else if (!/^\w{5,20}$/.test($.trim(userName))) {
            msg = "用户名格式不正确！";
        } else if ($.trim(password) == "") {
            msg = "密码不能为空！";
        } else if (!/^\w{6,20}$/.test($.trim(password))) {
            msg = "密码格式不正确！";
        }
        else if ($.trim(phone) == "") {
            msg = "电话号码不能为空！";
        } else if (!/^1[34578]\d{9}$/.test($.trim(phone))) {
            msg = "电话号码不能为空！";
        }
        if (msg != "") {
            $("#error-register-point").text(msg);
        }
        else {
            $.ajax({
                type: "POST",
                url: "http://localhost:9090/Pet/Back/UserController/addUser.php",
                data: "username=" + userName + "&password=" + password + "&phone=" + phone,
                success: function (response) {
                    $result = JSON.parse(response);
                    if ($result.code == 100) {
                        $('#dialogContainer').css('display', 'none');
                    }
                    else {
                        $("#error-register-point").text("注册失败");
                    }
                }
            });
        }
    });
    //登录
    $("#model-login").click(function () {
        var loginName = $("#loginName").val();
        var loginPwd = $("#loginPwd").val();
        var EMW = $("#EWM").val();
        var msg = "";
        if ($.trim(loginName) == "") {
            msg = "用户名不能为空！";
        } else if (!/^\w{5,20}$/.test($.trim(loginName))) {
            msg = "用户名格式不正确！";
        } else if ($.trim(loginPwd) == "") {
            msg = "密码不能为空！";
        } else if (!/^\w{6,20}$/.test($.trim(loginPwd))) {
            msg = "密码格式不正确！";
        }
        else if ($.trim(EMW) == "") {
            msg = "验证码不能为空！";
        } else if ($.trim(EMW) !== text) {
            msg = "验证码不正确！";
        }
        if (msg != "") {
            $("#error-login-point").text(msg);
        } else {
            $.ajax({
                type: "POST",
                url: "http://localhost:9090/Pet/Back/UserController/loginUser.php",
                data: "username=" + loginName + "&password=" + loginPwd,
                success: function (response) {
                    var data = JSON.parse(response);
                    if (data.code == 100) {
                        // 2.保存session
                        var user = data.data[0];
                        sessionStorage.setItem('user', JSON.stringify(user));
                        // 1.先隐藏登录显示
                        $('#dialogContainer2').css('display', 'none');
                        $('#notLogin').css('display', 'none');
                        $('#yesLogin').css('display', 'block');
                    }
                    else {
                        $("#error-login-point").text("用户名或密码输入错误");
                    }
                }
            });
        }
    });
    /*
     * 登录注册切换
     * */
    var changeLogin = document.querySelector('#changeLogin');
    var changeRegister = document.querySelector('#changeRegister');
    var dialogContainer = document.querySelector('#dialogContainer');
    var dialogContainer2 = document.querySelector('#dialogContainer2');
    changeLogin.onclick = function () {
        dialogContainer2.style.display = "block";
        dialogContainer.style.display = "none";
    };
    changeRegister.onclick = function () {
        dialogContainer2.style.display = "none";
        dialogContainer.style.display = "block";
    };


    /*
     * 获取首页的服务项类别以及传Id
     *
     * */
    var $servicecategoryData = [];
    var ul = document.querySelector('.service');
    $.ajax({
        method: 'GET',
        url: 'http://localhost:9090/Pet/Back/MenuController/menuList.php?method=getAllMenu',
        success: function (response) {
            if (response.code == 100) {
                $servicecategoryData = response.data;
                for (var i = 0; i < $servicecategoryData.length; i++) {
                    var li = createPetsService($servicecategoryData[i]);
                    ul.appendChild(li);
                }
            }
        },
        dataType: 'Json'
    });

    function createPetsService(item) {
        var li = document.createElement('li');
        var a = document.createElement('a');
        a.href = "#/pets?Id=" + item.Id;
        a.innerText = item.Name;
        a.onclick = function () {
            location.reload();
        };
        li.appendChild(a);
        return li;
    }
});