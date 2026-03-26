document.addEventListener("DOMContentLoaded",function(){
    console.log("domcontent loaded")

    const form = document.getElementById("workout_form");
    console.log("form gefunden:", form)

    form.addEventListener("submit",function(event){
        event.preventDefault();
        console.log("Submit gefeuert!");
        console.log("Online:", navigator.onLine);

        const uebungen = document.getElementById("übung").value ;
        const gewicht = document.getElementById("gewicht").value ;
        const wiederholungen = document.getElementById("wiederholungen").value;

        console.log("uebungen", uebungen);
        console.log("gewicht",gewicht);
        console.log("wiederholungen",wiederholungen);
        console.log("db",db);
        console.log("Gehe in if/else");
        if (navigator.onLine) {
            console.log("online")
            form.submit();
            console.log("fired");
            console.log("online", navigator.onLine);
        }else {
            console.log("offline")
            saveOffline(uebungen,gewicht,wiederholungen);
            console.log("wird aufgerufen");
            alert("offline");
        }
    });
});

