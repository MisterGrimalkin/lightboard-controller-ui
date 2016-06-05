function onLoad() {
    var ip = localStorage.getItem("ip");
    if ( ip ) {
        $("#ipaddress").val(ip);
        loadBoard();
    }
    
}

function loadScene(ip, name) {
    post(ip, "scene/"+name+"/load", "");
}

function post(ip, resource, data) {
    $.ajax({
        url: "http://"+ip+":8001/lightboard/"+resource,
        type: 'POST',
        data: data
    });
}

function loadBoard() {
    var ip = $("#ipaddress").val();
    localStorage.setItem("ip", ip);
    $("#board").attr("src", "board.php?ip="+ip);
}

function clearMessagePanel() {
    $("#messagePanel", parent.document).attr("src", "");
}

