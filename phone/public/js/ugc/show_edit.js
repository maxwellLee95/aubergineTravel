function showEditModal( e ){
    //绑定页面不允许滚动
    $('body').bind('touchmove', function (event) {
        event.preventDefault();
    });
    // $(".show-edit-btn").removeClass("hide-running");
    // $(".show-edit-btn").addClass("show-running");
    $("#editModal").removeClass("hiding");
    $("#editModal").removeClass("opacity-hide");
    $("#editModal").addClass("opacity-show");
    $(".new-index-nav").hide();
    $(".show-edit-btn").hide()
    // $(e).attr("onclick","hideEditModal(this);");
}

function hideEditModal( e ){
    //解除绑定页面不允许滚动
    $('body').unbind('touchmove');
    // $(".show-edit-btn").removeClass("show-running");
    // $(".show-edit-btn").addClass("hide-running");
    $("#editModal").removeClass("opacity-show");
    $("#editModal").addClass("opacity-hide");
    // $(e).attr("onclick","showEditModal(this);");
    $(".new-index-nav").show();
    $("#editModal").addClass("hiding");
    $(".show-edit-btn").show()
}
