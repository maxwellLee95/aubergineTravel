// cardListCallBack 实现回调
// var cardListCallBack = function(code){};
function cardListDetailClick(e, alwaysShow) {
    var errcode = $(e).data('errcode');
    var code = $(e).data('code');
    if (alwaysShow == 1) {
        $('.list_active').removeClass('list_active');
        $(e).addClass('list_active');
    } else {
        if (errcode != 0 && code != 0) {
            var errmsg = $.trim($(e).data('errmsg'));
            if (errmsg) {
                showNotice(errmsg, 1000);
            }
            return false;
        } else {
            $('.list_active').removeClass('list_active');
            $(e).addClass('list_active');
            var params = {
                "id": $(e).data('id'),
                "code": $(e).data('code'),
                "title": $(e).data('title'),
                "least_cost": $(e).data('leastcost'),
                "reduce_cost": $(e).data('reducecost'),
                "card_type": $(e).data('type'),
                "day": $(e).data('day'),
                "age": $(e).data('age')
            };
            hideCardList();
            if (typeof cardListCallBack == 'function') {
                cardListCallBack(params);
            }
        }
    }
}


function showCardList() {
    if (window.history.state != 'card_list') {
        window.history.pushState("card_list", null, "");
    }
    $('.card_list_box').addClass('card_list_in');
    $('.card_list_backdrop').addClass('card_list_in');
}

function hideCardList() {
    $('.card_list_box').removeClass('card_list_in');
    $('.card_list_backdrop').removeClass('card_list_in');
    window.history.go(-1);
}

//监听返回
$(window).on('popstate', function () {
    checkShowCardList();
});

//判断当前URL下对应的状态信息，展现对应的内容
function checkShowCardList(){
    if ($('.card_list_box').hasClass('card_list_in')) {
        if(window.history.state != "card_list" ){
            $('.card_list_box').removeClass('card_list_in');
            $('.card_list_backdrop').removeClass('card_list_in');
        }
    }
}

function changeCardTab( e ){
    var tabNum = $(e).data("tab");
    $(".card-tab").removeClass("active");
    $(".cards-content").removeClass("active");
    $(".card-tab").eq( tabNum ).addClass("active");
    $(".cards-content[data-tab='"+ tabNum +"']").addClass("active");
}

function addNewHikerPacket(){
    if( !newHikerCardList ){
        return false;
    }
    wx.addCard({
        cardList: newHikerCardList,
        success: function(res) {
        },
        fail: function(res) {
        }
    });
}