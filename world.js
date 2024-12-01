// document.addEventListener("DOMContentLoaded", function() {
//     var button1 = document.getElementById('lookup1');
//     var button2 = document.getElementById('lookup2');
   
    
//     // button1.addEventListener('click', function(){
//     //     const httpRequest = new XMLHttpRequest();
//     //     let url = "http://localhost/info2180-lab5/world.php";
//     //     httpRequest.onreadystatechange = doSomething;
//     //     httpRequest.open('GET', url);
//     //     httpRequest.send();

//     // });

//     // function doSomething() {
//     //     if (httpRequest.readyState === XMLHttpRequest.DONE) {
//     //         if (httpRequest.status === 200) {
//     //             let response = httpRequest.responseText;
//     //             alert(response);
//     //     } else {
//     //         alert('There was a problem with the request.');
//     //             }
//     //         }
//     //     }

//     button1.addEventListener("click", function () {
//         var input = document.getElementById('country').value.trim();
//         fetch('world.php')
//             .then(response => {
//                 if (!response.ok) {
//                     throw new Error(`HTTP error! Status: ${response.status}`);
//                 }
//                 return response.text();
//             })
//             .then(data => {
//                 try {
//                         const httpRequest = new XMLHttpRequest();
//                         alert(input);
//                         let url = `world.php?query=${encodeURIComponent(input)}`;;
//                         httpRequest.onreadystatechange = doSomething;
//                         httpRequest.open('GET', url);
//                         httpRequest.send();
    
//                         function doSomething() {
//                             if (httpRequest.readyState === XMLHttpRequest.DONE) {
//                                 if (httpRequest.status === 200) {
//                                     var response = httpRequest.responseText;
//                                     // document.getElementById("result").innerHTML = response;
//                                     // button1.addEventListener("click", function () { 
//                                     //     document.getElementById("result").innerHTML = null;
//                                     // });
//                             } else {
//                                 alert('There was a problem with the request.');
//                                 }
//                             }
//                         }
//                     // }
//                 } catch (err) {
//                     console.error('Error updating list:', err);
//                 }
//             })
//             .catch(error => console.error('Error fetching countries:', error));
//         });

//     button2.addEventListener('click', function(){


//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    var button1 = document.getElementById('lookup1');

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
});
