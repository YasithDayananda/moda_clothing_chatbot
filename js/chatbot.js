function openChat(){
    document.getElementById("chatbot-popup").style.display = "block";
}

function closeChat(){
    document.getElementById("chatbot-popup").style.display = "none";
}

function sendMessage(){
    console.log("Send button clicked"); // 👈 ADD THIS LINE

    let msg = document.getElementById("chatbot-input").value;
    if(msg.trim() === "") return;

    // Add user message
    let chatbox = document.getElementById("chatbot-messages");
    chatbox.innerHTML += `<p><b>You:</b> ${msg}</p>`;

    // Send message to PHP
    let formData = new FormData();
    formData.append("msg", msg);

    fetch("/sliit_first_year_web_development_project/chatbot/chat.php", {
    method: "POST",
    body: formData
})
.then(res => res.text())
.then(data => {
    console.log("SERVER RESPONSE:", data); // 👈 ADD THIS
    chatbox.innerHTML += `<p><b>MODA:</b> ${data}</p>`;
});

    document.getElementById("chatbot-input").value = "";
}