document.addEventListener("DOMContentLoaded", function() {
    const select = document.getElementById("uebung_select");
    const canvas = document.getElementById("gewicht_chart").getContext("2d");
    let chart;

    const uebungen = [];
    for (let i = 0; i < workoutData.length; i++) {
        const uebung = workoutData[i].uebung;
        if (!uebungen.includes(uebung)) {
            uebungen.push(uebung);
        }
    }

    for (let i = 0; i < uebungen.length; i++) {
        const option = document.createElement("option");
        select.appendChild(option);
        option.textContent = uebungen[i];
    }
    
    select.addEventListener("change", function() {
        const filteredoption = [];
        const selected = select.value;
        for (let i = 0; i < workoutData.length; i++) {
            if (workoutData[i].uebung === selected) {
                filteredoption.push(workoutData[i]);
            }
        }

        const labels = [];
        const datas = [];
        for (let i = 0; i < filteredoption.length; i++) {
            labels.push(filteredoption[i].datum);
            datas.push(parseFloat(filteredoption[i].gewicht));
        }

        if (chart) {
            chart.destroy();
        }

        chart = new Chart(canvas, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Gewicht (kg)",
                    data: datas,
                    backgroundColor: "#e94560"
                }]
            }
        });
        console.log(filteredoption);
        console.log(labels);
        console.log(datas);
    });
});