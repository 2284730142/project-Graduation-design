(function () {
    angular.module('app', ['ngRoute', 'app.controllers'])
        .config(['$routeProvider', /*'$sceDelegateProvider',*/ function ($routeProvider/*, $sceDelegateProvider*/) {
            /* $sceDelegateProvider.resourceUrlWhitelist([
             // Allow same origin resource loads.
             'self',
             // Allow loading from our assets domain.  Notice the difference between * and **.
             'http://192.168.9.27:7070/Pet/!*']);*/
            $routeProvider
            /**
             * 主页主界面模块
             * */
                .when('/', {

                    templateUrl: 'view/home.html',
                    controller: 'homeController'
                })
                .when('/pets', {
                    /*
                     * 宠物服务界面模块
                     * */
                    templateUrl: 'view/pets.html',
                    controller: 'petsController'
                })
                .when('/catRaise', {
                    /*
                     * 喵星人百科
                     * */
                    templateUrl: 'view/encyclopedia/catEncyclopedia.html'
                })
                .when('/dogRaise', {
                    /*
                     * 汪星人百科模块
                     * */
                    templateUrl: 'view/encyclopedia/dogEncyclopedia.html'
                })
                .when('/pigRaise', {
                    /*
                     * 小香猪百科模块
                     * */
                    templateUrl: 'view/encyclopedia/pigEncyclopedia.html'
                })
                .when('/totoroRaise', {
                    /*
                     * 龙猫百科模块
                     * */
                    templateUrl: 'view/encyclopedia/totoroEncyclopedia.html'
                })
            /**
             *  个人中心界面
             **/
                //个人中心
                .when('/personCenter', {
                    templateUrl: 'view/personalCenter/personCenter.html',
                    controller: 'personCenterController'
                })
                //修改个人信息
                .when('/changePersonInfor', {
                    templateUrl: 'view/personalCenter/changePersonInfor.html',
                    controller: 'changePersonInforController'
                })
                //我的订单
                .when('/personOrder', {
                    templateUrl: 'view/personalCenter/personOrder.html',
                    controller: 'personOrderController'
                })
                //修改密码
                .when('/changePassword', {
                    templateUrl: 'view/personalCenter/changePassword.html',
                    controller: 'changePasswordController'
                })
                //添加宠物
                .when('/createPetInfor', {
                    templateUrl: 'view/personalCenter/createPetInfor.html',
                    controller: 'createPetInforController'
                })
                //修改宠物信息
                .when('/changePetInfor/:item', {
                    templateUrl: 'view/personalCenter/changePetInfor.html',
                    controller: 'changePetInforController'
                })
                .when('/createOrder', {
                    /*
                     * 创建新订单
                     * */
                    templateUrl: 'view/personalCenter/createOrder.html',
                    controller: 'createOrderController'
                })
                .otherwise({
                    redirectTo: '/'
                });
        }]);
})();