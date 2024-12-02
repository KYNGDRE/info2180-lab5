document.addEventListener("DOMContentLoaded", function () {
    var button1 = document.getElementById('lookup1');
    var button2 = document.getElementById('lookup2');

    button1.addEventListener("click", function () {
        var input = document.getElementById('country').value.trim();
        let url = `world.php?country=${encodeURIComponent(input)}`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => console.error('Error fetching countries:', error));
    });

    // var button1 = document.getElementById('lookup1');

    button2.addEventListener("click", function () {
        var input = document.getElementById('country').value.trim();
        let url = `world.php?country=${encodeURIComponent(input)}&lookup=cities`;

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                document.getElementById("result").innerHTML = data;
            })
            .catch(error => console.error('Error fetching countries:', error));
    });
});
