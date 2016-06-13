function onLoad() {
    var ip = localStorage.getItem("ip");
    if (ip) {
        $("#ipaddress").val(ip);
        loadBoard();
    }

}

function loadScene(ip, name) {
    post(ip, "scene/" + name + "/load", "");
}

function post(ip, resource, data) {
    $.ajax({
        url: "http://" + ip + ":8001/lightboard/" + resource,
        type: 'POST',
        data: data
    });
}

function loadBoard() {
    var ip = $("#ipaddress").val();
    localStorage.setItem("ip", ip);
    $("#board").attr("src", "board.php?ip=" + ip);
}

function clearMessagePanel() {
    $("#messagePanel", parent.document).attr("src", "");
}

function saveMessages(ip, scene, group) {
    var messages = [];
    for (var si = 0; si < setCount; si++) {
        var message = "";
        var ignore = false;
        for (var mi = 0; mi < msgCount; mi++) {
            field = $("#msg-" + si + "-" + mi);
            if (mi > 0) {
                message += ";;";
            }
            var thisMessage = field.val();
            if (thisMessage) {
                message += thisMessage;
            } else {
                ignore = setCount > 0;
            }
        }
        if (!ignore) {
            messages.push(message);
        }
    }
    if (messages.length > 0) {
        clearMessages(ip, scene, group);
        setTimeout(function () {

            for (var i = 0; i < messages.length; i++) {
                post(ip, "scene/" + scene + "/group/" + group + "/add", messages[i]);
                console.log(i + "=" + messages[i]);
            }
//            post(ip, "scene/" + scene + "/load", "");
            setTimeout(function () {
                $("#messagePanel", parent.document).attr("src", "messages.php?ip=" + ip + "&scene=" + scene + "&group=" + group);
            }, 1000);
        }, 500);
    }
}

function clearMessages(ip, scene, group) {
    post(ip, "scene/" + scene + "/group/" + group + "/clear", "");
    setTimeout(function () {
        $("#messagePanel", parent.document).attr("src", "messages.php?ip=" + ip + "&scene=" + scene + "&group=" + group);
    }, 1000);
}

var setCount = 0;
var msgCount = 0;

function addMessageRow(width) {
    var div = document.createElement("div");
    div.className = "messageset";
    for (var i = 0; i < msgCount; i++) {
        var input = document.createElement("input");
        input.type = "text";
        input.style.width = width + "%";
        input.id = "msg-" + setCount + "-" + i;
        div.appendChild(input);
    }
    $("#messageList").append(div);
    setCount++;
}

