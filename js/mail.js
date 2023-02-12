function sendMail() {
    var params = {
        from_name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        message: document.getElementById("message").value,
    };

    const serviceID = "service_ix7y0ve";
    const templateID = "template_1j2ff8d";

    emailjs.send(serviceID, templateID, params)
        .then(
            resp => {
                document.getElementById("name").value = "";
                document.getElementById("email").value = "";
                document.getElementById("message").value = "";
                console.log(resp);
                alert("Your sent message sent successfully!");
            }
        ).catch(e => console.log(e))
}
