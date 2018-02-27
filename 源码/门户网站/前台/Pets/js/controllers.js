/**
 * Created by Administrator on 2017/10/31 0031.
 */
(function () {
    angular.module('app.controllers', ['app.services'])
    /**
     * 主页主界面模块
     * */
        .controller('homeController', ['$scope', function ($scope) {
            /**
             * 主界面滑动
             * */
            new FullPage({
                id: 'pageContain',
                slideTime: 800,
                effect: {
                    transform: {
                        translate: 'Y'
                    },
                    opacity: [0, 1]
                },
                mode: 'wheel, touch, nav:navBar',
                easing: 'ease-out'
            });
        }])
        /*
         * 宠物服务界面模块
         * */
        .controller('petsController', ['$scope', 'petsService', '$location', function ($scope, petsService, $location) {
            $scope.URL = "http://localhost:9090/Pet/Back/Source/video/";
            // 1.获取页面id
            $scope.string = $location.url();//获取url中的Id.
            $scope.id = $scope.string.slice(9);//截取url

            //标题的变量
            $scope.petServiceName = '';

            //video中的变量
            $scope.video = "";

            //设置显示的数量
            $scope.viewNum = 3;
            //设置显示的数据
            $scope.serviceViewData = [];
            //设置当前已显示数量
            $scope.currentNum = 0;
            $scope.flag = 0;
            //设置显示信息
            $scope.moreInfo = "点击加载更多哦！~";

            // 3.通过id获取当前具体服务项的列表
            $scope.serviceData = [];
            loadserviceData();
            function loadserviceData() {
                petsService.list($scope.id).then(function (response) {
                    // 获取数据的listData
                    $scope.serviceData = response.data.data;
                    // 得到显示的数据
                    for (var i = 0; i < $scope.viewNum; i++) {
                        $scope.serviceViewData.push($scope.serviceData[i]);
                        $scope.currentNum++;
                    }
                    $scope.flag = $scope.currentNum;
                    /*console.log($scope.serviceData);*/
                    /* pagingNumber($scope.serviceData);*/
                })
            }

            // 加载更多
            $scope.addMore = function () {
                if (($scope.flag + $scope.viewNum) > $scope.serviceData.length) {
                    for (var k = $scope.flag; k < $scope.serviceData.length; k++) {
                        $scope.serviceViewData.push($scope.serviceData[k]);
                        $scope.currentNum++;
                    }
                } else {
                    for (var j = $scope.flag; j < ($scope.flag + $scope.viewNum); j++) {
                        $scope.serviceViewData.push($scope.serviceData[j]);
                        $scope.currentNum++;
                    }
                }
                $scope.flag = $scope.currentNum;
                if($scope.flag == $scope.serviceData.length){
                    $scope.moreInfo = "不好意思没有啦！~";
                }
            };

            // 2.定义video中的变量,通过id判断,就给ng-src设置值
            //美容
            if ($scope.id === "34023286-be06-11e7-99bc-14dda97c32c8") {
                $scope.video = $scope.URL + "02.mp4";
                $('#myVideo').attr('src', $scope.video);
                $scope.petServiceName = "宠物美容";
            }
            //寄养
            if ($scope.id === "3402349a-be06-11e7-99bc-14dda97c32c8") {
                $scope.video = $scope.URL + "04.mp4";
                $('#myVideo').attr('src', $scope.video);
                $scope.petServiceName = "宠物寄养";
            }
            //医疗
            if ($scope.id === "340234c7-be06-11e7-99bc-14dda97c32c8") {
                $scope.video = $scope.URL + "03.mp4";
                $('#myVideo').attr('src', $scope.video);
                $scope.petServiceName = "宠物医疗";
            }
            //摄影
            if ($scope.id === "340234f4-be06-11e7-99bc-14dda97c32c8") {
                $scope.video = $scope.URL + "01.mp4";
                $('#myVideo').attr('src', $scope.video);
                $scope.petServiceName = "宠物摄影";
            }

            //获取服务标题的名字
            $scope.titleData = [];
            loadtitleData();
            function loadtitleData() {
                petsService.category().then(function (response) {
                    $scope.titleData = response.data;
                })
            }

            /*
             * 预约订单的业务
             * */
            //预定点击事件
            $scope.order = function (id) {
                //用户没登录点击预定的情况
                if (!sessionStorage.getItem('user')) {
                    //没有登录显示模态框
                    SimplePop.alert("1", "提示信息：", "确认", "亲，您还没有登录哦！~");
                }
                //用户登录后点击预定，判断信息是否完整
                else {
                    //获取到登录用户对象信息
                    var a = JSON.parse(sessionStorage.getItem('user'));
                    //用户对象转成索引数组
                    var arr = [];
                    var flag = 0;
                    for (var i in a) {
                        var str = a[i];
                        arr.push(str);
                    }
                    //点击预约用户没有完善信息的模态框
                    for (var j = 0; j < arr.length; j++) {
                        if (arr[j] == "") {
                            SimplePop.confirm(function () {

                            }, "1", "提示信息：", "确认", "取消", "亲，您的信息还没有完善，完善后才可以继续下单哦！~", {
                                type: "error"
                            });
                        } else {
                            flag++;
                        }
                    }
                    if (flag == arr.length) {
                        $location.url('createOrder?Id=' + id);
                    }
                }
            };
        }])
        /**
         * 个人设置
         * **/
        //个人中心页面
        .controller('personCenterController', ['$scope', '$location', 'loadPetsService','$window',function ($scope, $location, loadPetsService,$window) {
            //获取个人中心信息
            if (!sessionStorage.getItem('user')) {
                $location.path('/');
            }
            $scope.personInfoList = JSON.parse(sessionStorage.getItem('user'));//存放当前用户信息
            $scope.petInfoList = '';//存放宠物信息
            //通过用户Id获取宠物信息
            loadPetsService.loadPet($scope.personInfoList.Id).then(function (result) {
                if (result.data.code == 100) {
                    $scope.petInfoList = result.data.data;
                    //console.log($scope.petInfoList);
                }
            });
            //删除宠物信息
            $scope.currentPet = {};//存放当前宠物的Id和用户Id
            $scope.currentPet.userId = $scope.personInfoList.Id;
            $scope.btnDelete = function (item) {
                SimplePop.confirm(function () {
                    $scope.currentPet.Id = item;
                    loadPetsService.deletePet($scope.currentPet).then(function (result) {
                        //console.log(result);
                        if (result.data.code == 100) {
                            $window.location.reload();
                        }
                    })
                }, "0", "提示信息：", "确认", "取消", "主人你要抛弃我了吗？");
            }
        }])
        //修改个人信息
        .controller('changePersonInforController', ['$scope', 'editPersonService', '$location', function ($scope, editService, $location) {
            //获取当前用户信息
            $scope.changePer = JSON.parse(sessionStorage.getItem('user'));
            //提交表单
            $scope.btnChangePer = function () {
                editService.editPersonInfo($scope.changePer).then(function (result) {
                    //console.log(result);
                    if (result.data.code == 100) {
                        SimplePop.alert("0", "提示信息：", "确认", "修改信息成功！~");
                        $scope.list = result.data.data;
                        sessionStorage.setItem('user', JSON.stringify($scope.list[0]));
                        $location.path('personCenter');
                    }
                })
            };
        }])
        //我的订单
        .controller('personOrderController', ['$scope', 'orderService','$window', function ($scope, orderService,$window) {
            //获取订单
            $scope.myOrderList = [];//存放我的全部订单
            $scope.myOrder = [];
            $scope.myOrderListUnSet = [];//存放已取消订单
            $scope.myOrderListSet = [];//存放已预约订单
            $scope.isShowBtn = true;
            $scope.userId = JSON.parse(sessionStorage.getItem('user')).Id;

            $scope.active1 = 'active';
            $scope.active2 = '';
            $scope.active3 = '';
            orderService.loadOrder($scope.userId).then(function (result) {
                //console.log(result);
                if (result.data.code == 100) {
                    $scope.myOrderList = result.data.data;
                    $scope.myOrder = $scope.myOrderList;
                    //console.log($scope.myOrderList);
                    //删选信息 判断state为3的就是已取消，不是的就是已预约
                    for (var i = 0; i < $scope.myOrderList.length; i++) {
                        if ($scope.myOrderList[i].State == 3) {
                            $scope.myOrderListUnSet.push($scope.myOrderList[i]);
                        } else {
                            $scope.myOrderListSet.push($scope.myOrderList[i]);
                        }
                    }
                }
            });
            //点击我的订单
            $scope.btnOrder = function () {
                $scope.myOrder = $scope.myOrderList;
                $scope.active1 = 'active';
                $scope.active2 = '';
                $scope.active3 = '';
            };
            //点击已预约订单
            $scope.btnOrderTrue = function () {
                $scope.myOrder = $scope.myOrderListSet;
                $scope.active1 = '';
                $scope.active2 = 'active';
                $scope.active3 = '';
            };
            //点击已取消订单
            $scope.btnOrderFalse = function () {
                $scope.myOrder = $scope.myOrderListUnSet;
                $scope.active1 = '';
                $scope.active2 = '';
                $scope.active3 = 'active';
            };
            //改变订单状态
            $scope.cancel = {};
            $scope.cancel.userId = $scope.userId;
            $scope.btnCancel = function (item) {
                SimplePop.confirm(function(){
                    $scope.cancel.Id = item;
                    orderService.changeOrder($scope.cancel).then(function (result) {
                        //console.log(result);
                        if (result.data.code == 100) {
                            $window.location.reload();
                        }
                    });
                }, "0", "提示信息：", "确认", "取消", "确认取消预约?");
            }
        }])
        //修改密码
        .controller('changePasswordController', ['$scope', 'changePasswordService', '$location', function ($scope, chPs, $location) {
            $scope.newPassword = {};
            //获取当前用户信息
            $scope.newPassword.userId = JSON.parse(sessionStorage.getItem('user')).Id;
            $scope.btnNewPassword = function () {
                chPs.changePass($scope.newPassword).then(function (result) {

                    if (result.data.code == 100) {
                        SimplePop.alert("0", "提示信息：", "确认", "修改密码成功~");
                        $location.path('personCenter');
                    }
                });
            }
        }])
        //添加宠物信息
        .controller('createPetInforController', ['$scope', 'newPetService', '$location', function ($scope, $newPetService, $location) {

            $scope.petClassList = '';//存放宠物类别
            $scope.newPet = {};
            $scope.submitted = false;
            //获取当前用户信息
            var userInformation = JSON.parse(sessionStorage.getItem('user'));
            //console.log(userInformation);
            $scope.newPet.personName = userInformation.LoginName;
            $scope.newPet.personId = userInformation.Id; //获取当前用户Id
            //获取宠物类别
            $newPetService.petClassIN().then(function (result) {
                //console.log(result);
                if (result.data.code == 100) {
                    $scope.petClassList = result.data.data;
                }
            });
            //提交
            $scope.btnNewPet = function () {
                if ($scope.myForm.$valid) {
                    $newPetService.newPetSubmit($scope.newPet).then(function (result) {
                        if (result.data.code == 100) {
                            SimplePop.alert("0", "提示信息：", "确认", "添加宠物成功~");
                            $location.path('personCenter');
                        }
                    });
                } else {
                    $scope.submitted = true;
                }
            };
        }])
        //修改宠物信息
        .controller('changePetInforController', ['$scope', '$routeParams', 'editPetService', '$location', function ($scope, $routeParams, edit, $location) {
            //获取当前编辑的宠物信息
            $scope.currentList = JSON.parse($routeParams.item);
            $scope.currentList.userId = JSON.parse(sessionStorage.getItem('user')).Id;
            //console.log($scope.currentList);
            //提交表单
            $scope.btnChangePet = function () {
                edit.petChange($scope.currentList).then(function (result) {
                    //console.log(result);
                    if (result.data.code == 100) {
                        SimplePop.alert("0", "提示信息：", "确认", "亲，您的宠物信息修改成功！~");
                        $location.path('personCenter');
                    }
                })
            };
            //获取宠物类别
            $scope.petClassList = '';
            edit.petClassIN().then(function (result) {
                if (result.data.code == 100) {
                    $scope.petClassList = result.data.data;
                }
            });
        }])
        //创建新订单
        .controller('createOrderController', ['$scope', 'ordercreateService', '$location', function ($scope, ordercreateService, $location) {
            $scope.newOrder = {};
            $scope.petDate = {};
            $scope.ServiceData = [];
            $scope.personData = [];
            // 1.获取页面id
            $scope.string = $location.url();//获取url中的Id.
            $scope.id = $scope.string.slice(16);//截取url
            //获取具体服务项目
            ordercreateService.order($scope.id).then(function (response) {
                $scope.ServiceData = response.data.data[0];
                $scope.newOrder.serviceName = $scope.ServiceData.Name;
                $scope.newOrder.serviceId = $scope.ServiceData.Id;
            });
            //获取宠物信息
            var userId = JSON.parse(sessionStorage.getItem('user')).Id;
            ordercreateService.loadPet(userId).then(function (response) {
                console.log(response);
                if (response.data.code == 100) {
                    $scope.petDate = response.data.data;
                    $scope.petId = $scope.petDate[0].Id;
                    console.log($scope.petId);
                }
            });
            //获取用户名和用户id
            ordercreateService.personList(userId).then(function (response) {
                if (response.data.code == 100) {
                    $scope.personData = response.data.data[0];
                    $scope.newOrder.personName = $scope.personData.TrueName;
                    $scope.newOrder.personId = $scope.personData.Id;
                }
            });
            //设置下单时间
            var date = new Date();
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            var day = date.getDate();
            var hour = date.getHours();
            var minute = date.getMinutes();
            var seconds = date.getSeconds();
            if (month < 10) {
                month = '0' + month;
            }
            if (day < 10) {
                day = '0' + day;
            }
            if (hour < 10) {
                hour = '0' + hour;
            }
            if (minute < 10) {
                minute = '0' + minute;
            }
            if (minute < 10) {
                minute = '0' + minute;
            }
            if (seconds < 10) {
                seconds = '0' + seconds;
            }
            //console.log(year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + seconds);
            $scope.newOrder.orderDate = year + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + seconds;
            $scope.btnNewOrder = function () {
                ordercreateService.createOrder($scope.newOrder).then(function (response) {
                    //console.log(response);
                    if(response.data.code == 100){
                        SimplePop.alert("0", "提示信息：", "确认", "预约成功！~");
                        $location.path('personOrder');
                    }
                })
            };

        }]);
})();