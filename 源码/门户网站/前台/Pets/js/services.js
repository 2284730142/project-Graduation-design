/**
 * Created by Administrator on 2017/10/31 0031.
 */
(function () {
    angular.module('app.services', [])
        .constant('URL_ROOT', 'http://127.0.0.1:9090')
    /**
     * 个人设置操作
     * **/
        //添加新宠物
        .service('newPetService', ['$http', function ($http) {
            this.petClassIN = function () {
                return $http.get('http://localhost:9090/Pet/Back/PetController/petCategory.php?method=getPetCategory');
            };
            this.newPetSubmit = function (newPet) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/PetController/pets.php',
                    data: newPet,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('method', 'addPets');
                        frm.append('userId', data.personId);
                        frm.append('name', data.name);
                        frm.append('cateId', data.classId);
                        frm.append('sex', data.sex);
                        frm.append('age', data.old);
                        return frm;
                    }
                })
            };
        }])
        //修改密码
        .service('changePasswordService', ['$http', function ($http) {
            this.changePass = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/UserController/pwdEdit.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('id', data.userId);
                        frm.append('oldpassword', data.old);
                        frm.append('newpassword', data.new);
                        return frm;
                    }
                })
            }
        }])
        //修改个人信息
        .service('editPersonService', ['$http', function ($http) {
            this.editPersonInfo = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/UserController/editUser.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('id', data.Id);
                        frm.append('address', data.Address);
                        frm.append('truename', data.TrueName);
                        frm.append('cardid', data.CardId);
                        frm.append('sex', data.Sex);
                        frm.append('phone', data.Phone);
                        return frm;
                    }
                });
            }
        }])
        //个人中心信息
        .service('loadPetsService', ['$http', function ($http) {
            //获取宠物信息
            this.loadPet = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/PetController/pets.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('userId', data);
                        frm.append('method', 'getPets');
                        return frm;
                    }
                });
            };
            this.deletePet = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/PetController/pets.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('id', data.Id);
                        frm.append('userId', data.userId);
                        frm.append('method', 'deletePets');
                        return frm;
                    }
                });
            }
        }])
        //修改宠物信息
        .service('editPetService', ['$http', function ($http) {
            this.petClassIN = function () {
                return $http.get('http://localhost:9090/Pet/Back/PetController/petCategory.php?method=getPetCategory');
            };
            //提交表单
            this.petChange = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/PetController/pets.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('id', data.Id);
                        frm.append('name', data.Name);
                        frm.append('cateId', data.cateId);
                        frm.append('sex', data.Sex);
                        frm.append('age', data.Age);
                        frm.append('userId', data.userId);
                        frm.append('method', 'editPets');
                        return frm;
                    }
                });
            }
        }])
        //订单信息管理
        .service('orderService', ['$http', function ($http) {
            //获取预约
            this.loadOrder = function (userId) {
                return $http.get('http://localhost:9090/Pet/Back/OrderController/getOneOrder.php?id=' + userId);
            };
            //取消预约
            this.changeOrder = function (item) {
                return $http.get('http://localhost:9090/Pet/Back/OrderController/changeState.php?id=' + item.userId + '&orderid=' + item.Id);
            }
        }])
    /**
     * 宠物服务的service
     * */
        .service("petsService", ['$http', function ($http) {
            this.category = function () {
                return $http.get('http://localhost:9090/Pet/Back/MenuController/menuList.php?method=getAllMenu');
            };
            /*
             * 获取宠物服务项
             * */
            this.list = function ($id) {
                return $http.get('http://localhost:9090/Pet/Back/MenuController/menuDetailList.php?id=' + $id);
            }
        }])
        /*
         * 创建新订单
         * */
        .service("ordercreateService", ['$http', function ($http) {
            this.order = function ($id) {
                return $http.get('http://localhost:9090/Pet/Back/MenuController/getServiceById.php?id=' + $id);
            };

            //通过主人id获取宠物id
            this.loadPet = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/PetController/pets.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('userId', data);
                        frm.append('method', 'getPets');
                        return frm;
                    }
                });
            };

            this.personList = function ($id) {
                return $http.get('http://localhost:9090/Pet/Back/UserController/getUserById.php?id=' + $id);
            };

            this.createOrder = function (item) {
                return $http({
                    method: 'post',
                    url: 'http://localhost:9090/Pet/Back/OrderController/createOrder.php',
                    data: item,
                    headers: {'Content-type': undefined},
                    transformRequest: function (data) {
                        var frm = new FormData();
                        frm.append('userid', data.personId);
                        frm.append('menuid', data.serviceId);
                        frm.append('petid', data.petId);
                        frm.append('date', data.orderDate);
                        frm.append('message', data.message);
                        return frm;
                    }
                });
            }

        }]);
})();