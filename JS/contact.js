function clearContactForm() {
    var name = $("name");
    var email = $("email");
    var subject = $("subject");
    var message = $("message");
    
    name.value = "";
    email.value = "";
    subject.value = "";
    message.value = "";

    name.className = "FORMINPUT_TXT";
    email.className = "FORMINPUT_TXT";
    subject.className = "FORMINPUT_TXT";
    message.className = "FORMINPUT_TXTAREA";

    var name_label = $("name_label");
    var email_label = $("email_label");
    var subject_label = $("subject_label");
    var message_label = $("message_label");

    name_label.className = "FORM_LABEL";
    email_label.className = "FORM_LABEL";
    subject_label.className = "FORM_LABEL";
    message_label.className = "FORM_LABEL";
}

function validateContactForm() {
    var name = $("name");
    var email = $("email");
    var subject = $("subject");
    var message = $("message");

    var name_label = $("name_label");
    var email_label = $("email_label");
    var subject_label = $("subject_label");
    var message_label = $("message_label");

    
    if(name.value == "") {  
        name.className = "FORMINPUT_TXT_HIGHLIGHT";
        name_label.className = "FORM_LABEL_HIGHLIGHT";
        return false;
    }
    else {
        name.className = "FORMINPUT_TXT";
        name_label.className = "FORM_LABEL";
    }
        
    if((email.value == "") || (email.value.indexOf("@") == -1) || (email.value.indexOf(".") == -1)) {  
        email.className = "FORMINPUT_TXT_HIGHLIGHT";
        email_label.className = "FORM_LABEL_HIGHLIGHT";
        return false;
    }
    else {
        email.className = "FORMINPUT_TXT";
        email_label.className = "FORM_LABEL";
    }     
        
    if(subject.value == "") {  
        subject.className = "FORMINPUT_TXT_HIGHLIGHT";
        subject_label.className = "FORM_LABEL_HIGHLIGHT";
        return false;
    }
    else {
        subject.className = "FORMINPUT_TXT";
        subject_label.className = "FORM_LABEL";
    }    
        
    if(message.value == "") {  
        message.className = "FORMINPUT_TXTAREA_HIGHLIGHT";
        message_label.className = "FORM_LABEL_HIGHLIGHT";
        return false;
    }
    else {
        message.className = "FORMINPUT_TXTAREA";
        message_label.className = "FORM_LABEL";
    }  
        
    return true;        
}