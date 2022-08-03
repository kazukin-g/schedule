window.addEventListener("DOMContentLoaded",function(){

    var monthCalendar = document.querySelector("#monthCalendar");
    var days = document.getElementById("days");
    var text = document.getElementById("text");
    var user = document.querySelector("#user");
    var month = document.querySelector("#month");
    var year = document.querySelector("#year");

});

monthCalendar.addEventListener("change", () =>{
    var radio = document.querySelector("input[name=month]:checked");
    var plan = document.querySelectorAll(".plan");
    plan.forEach( (p) => {
        text.removeChild(p);
    });
    if(radio){
        days.innerHTML= year.textContent +"年"+ month.textContent +"月"+ radio.value +"日の予定";
        var url = "./scheduleGet.php?year="+ year.textContent +"&&month="+ month.textContent +"&&day="+ radio.value;
        var req = new Request(url,{
            method: "get"
        });
        fetch(req).then(res => {
            return res.json();
        }).then( data =>{
            dataGet(data);
        });
    }
});

function dataGet(result){
    result.forEach( (r) => {
        display(r);
    });
}
function display(r){
    var label = document.createElement("label");
    label.setAttribute("for", r["author"]);
    label.setAttribute("class", "plan");
    label.innerHTML = r["author"] +"<br>";
    text.appendChild(label);
    var check = document.createElement("input");
    check.setAttribute("type", "checkbox");
    check.setAttribute("class", "plan");
    check.setAttribute("id", r["author"]);
    text.appendChild(check);
    if(r["author"] === user.value){
        yourself(r);
    } else {
        others(r);
    }
}

function yourself(r){
    var form = document.createElement("form");
    form.setAttribute("class", "plan");
    form.setAttribute("id", r["author"] + r["day"]);
    form.setAttribute("method", "post");
    text.appendChild(form);

    form = document.getElementById(r["author"] + r["day"]);
    var p = document.createElement("p");
    p.innerHTML = "予定："+ r["text"];
    form.appendChild(p);
    var button = document.createElement("input");
    button.setAttribute("type", "submit");
    button.setAttribute("value", "変更");
    button.setAttribute("formaction", "./mypage.php?change=textChange");
    form.appendChild(button);
    button = document.createElement("input");
    button.setAttribute("type", "submit");
    button.setAttribute("value", "削除");
    button.setAttribute("formaction", "./mypage.php?change=delete");
    form.appendChild(button);
}

function others(r){
    var div = document.createElement("div");
    div.setAttribute("class", "plan");
    div.setAttribute("id", r["author"] + r["day"]);
    text.appendChild(div);

    div = document.getElementById(r["author"] + r["day"]);
    var p = document.createElement("p");
    p.innerHTML = "予定："+ r["text"];
    div.appendChild(p);
}