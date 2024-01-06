<head>
    <style>
        /* CSS cho nút điện thoại */

.contact-button:hover {
    cursor: pointer; 
    scale: 0.92;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.5);
}

#messenger-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff; /* Màu nền của nút */
    border-radius: 50%; /* Để làm cho nút hình tròn */
    padding: 9px 11px; /* Kích thước nút */
}

#messenger-button a {
    display: block;
    text-align: center;
    text-decoration: none;
    color: white; /* Màu chữ của nút */
}

/* Tương tự cho nút email và nút messenger */
#email-button {
    position: fixed;
    bottom: 90px;
    right: 20px;
    background-color: #ff5722;
    border-radius: 50%;
    padding: 13px 11px;
}

#email-button a {
    display: block;
    text-align: center;
    text-decoration: none;
    color: white;
}

#phone-button {
    position: fixed;
    bottom: 160px;
    right: 20px;
    background-color: #28D230;
    border-radius: 50%;
    padding: 2px 5px;
}

#phone-button  a {
    display: block;
    text-align: center;
    text-decoration: none;
    color: white;
}

    </style>
</head>
<!-- Nút điện thoại -->
<div class="contact-button" id="phone-button">
    <a href="tel:0946172333"><img src="../banutlienhe/img/phone-flat.png" alt="Phone" width="50px"></a>
</div>

<!-- Nút email -->
<div class="contact-button" id="email-button">
    <a href="mailto:hainamtk56@gmail.com"><img src="../banutlienhe/img/Gmail_Icon_(2013-2020).svg.png" alt="Email" width="38px"></a>
</div>

<!-- Nút messenger -->
<div class="contact-button" id="messenger-button">
    <a href="https://m.me/Nhuquynh010123" target="_blank"><img src="../banutlienhe/img/Facebook_Messenger_logo_2020.svg.png" alt="Messenger" width="38px"></a>
</div>