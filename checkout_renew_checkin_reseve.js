
function checkout_resources(){
  let status= "checkout";
  let xhttp = new XMLHttpRequest();
  let isbn = document.getElementById("isbn").value;
  let passport_number = document.getElementById('passport_number').value;
  xhttp.open("POST", "patron_checkout_submit.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var checkout = document.getElementById('checkout').value==="checkout"?"checkout":"";
  var emailSent = document.getElementById("emailSent").checked?"sendEmail":"";
  if(checkout==="checkout"){
    xhttp.send("isbn="+isbn+"&status="+status+"&checkout="+checkout+"&emailSent="+emailSent);
  } else {
    xhttp.send("isbn="+isbn+"&status="+status+"&checkout="+checkout+"&emailSent="+emailSent);
  }
  xhttp.onreadystatechange = function() {

  if(this.readyState === 4 && this.status === 200){
    let response = JSON.parse(this.responseText);

    if(response.validate_isbn==="ONE"){
      let validateIsbn = document.getElementById('isbn_incorrect');
      let validateIsbnClass = document.createAttribute("class");
      validateIsbnClass.value = "glyphicon glyphicon-remove text-danger";
      validateIsbn.setAttributeNode(validateIsbnClass);
    }
    if(response.resources_borrowed==="TWO"){
      let resourcesBorrowed = document.getElementById('already_borrowed');
      let resourcesBorrowedClass = document.createAttribute("class");
      resourcesBorrowedClass.value = "glyphicon glyphicon-remove text-danger";
      resourcesBorrowed.setAttributeNode(resourcesBorrowedClass);
    }

    if(response.checkout_limit==="THREE"){
      let validateCheckoutLimit = document.getElementById('exceed_limit');
      let validateCheckoutLimitClass = document.createAttribute("class");
      validateCheckoutLimitClass.value = "glyphicon glyphicon-remove text-danger";
      validateCheckoutLimit.setAttributeNode(validateCheckoutLimitClass);
    }

    if(response.resource_available==="FOUR"){
      let validateResourceAvailable = document.getElementById('book_available');
      let resourceAvailableClass = document.createAttribute("class");
      resourceAvailableClass.value = "glyphicon glyphicon-remove text-danger";
      validateResourceAvailable.setAttributeNode(resourceAvailableClass);
    }
    if(response.due_return ==="FIVE"){
      let validateDueReturn = document.getElementById('due_return');
      let dueReturnClass = document.createAttribute("class");
      dueReturnClass.value = "glyphicon glyphicon-remove text-danger";
      validateDueReturn.setAttributeNode(dueReturnClass);
    }
    if(response.checkout ==="checkout"){
      var tableRow = document.createElement("tr");
      var tableData1 = document.createElement("td");
      var tableData2 = document.createElement("td");
      var tableData3 = document.createElement("td");
      var tableData4 = document.createElement("td");
      var tableData5 = document.createElement("td");
      var tableData6 = document.createElement("td");
      let spaceBefore = document.createElement("br");

    var isbnData = document.createTextNode(response.isbn);
    var titleData = document.createTextNode(response.title);
    var authorData = document.createTextNode(response.author);
    var dateBorrowedData = document.createTextNode(response.Date_borrowed);
    var dueDateData = document.createTextNode(response.Due_Date);
    var statusData = document.createTextNode(response.status);


    tableData1.appendChild(isbnData);
    tableData2.appendChild(titleData);
    tableData3.appendChild(authorData);
    tableData4.appendChild(dateBorrowedData);
    tableData5.appendChild(dueDateData);
    tableData6.appendChild(statusData);


    tableRow.appendChild(tableData1);
    tableRow.appendChild(tableData2);
    tableRow.appendChild(tableData3);
    tableRow.appendChild(tableData4);
    tableRow.appendChild(tableData5);
    tableRow.appendChild(tableData6);
    tableRow.appendChild(spaceBefore);


    var element = document.getElementById('remove_resource');
    element.appendChild(tableRow);


    let renewBtn = document.createElement("button");
    let spaceElem = document.createElement("hr");
    let renewTxt = document.createTextNode("Renew");
    let renewClass = document.createAttribute("class");

    renewClass.value = "btn btn-success";

    renewBtn.appendChild(renewTxt);
    renewBtn.setAttributeNode(renewClass);
    tableRow.appendChild(renewBtn);
    tableRow.appendChild(spaceElem);



    let checkinBtn = document.createElement("button");
    let spaceElement = document.createElement("hr");
    let checkinTxt = document.createTextNode("check in");
    let checkinClass = document.createAttribute("class");

    checkinClass.value = "btn btn-danger";

    checkinBtn.appendChild(checkinTxt);
    checkinBtn.setAttributeNode(checkinClass);
    tableRow.appendChild(checkinBtn);
    tableRow.appendChild(spaceElement);
    element.appendChild(tableRow);
    let anulCheckout = document.getElementById("checkout");
    anulCheckout.value = "";
    document.getElementById("checkout").innerHtml ="";
  }

      if(response.checkoutMode ==="checkout_process"){
        let submitBtn = submitBtnDataToggle = submitBtnDataTarget = submitBtnDataBackdrop = submitBtnDataKeyboard = picture = modalTitle =
        modalAuthor = modalAuthor = modalPublicationDate = modalIsbn = modalDateBorrowed =  modalDateReturned = modalStatus = bookPictureSrc =
        modalTitleText = modalAuthorText = modalDateBorrowedText = modalDateBorrowedText = modalStatusText = modalIsbnText = modalPublicationDateText=
        checkout= modalDateReturnedText ="";


        document.getElementById('modal-title').textContent="";
        document.getElementById('modal-author').textContent="";
        document.getElementById('modal-publication-date').textContent="";
        document.getElementById('modal-isbn').textContent="";
        document.getElementById('modal-date-borrowed').textContent="";
        document.getElementById('modal-date-returned').textContent="";
        document.getElementById('modal-status').textContent="";


        //document.getElementById('checkout');
        document.getElementById('checkout').style.display="block";
        document.getElementById('checkin').style.display="none";
        document.getElementById('renewCheckout').style.display="none";
        document.getElementById('checkoutReserve').style.display="none";


        picture = document.getElementById('picture');
        modalTitle = document.getElementById('modal-title').textContent;
        modalAuthor = document.getElementById('modal-author').textContent;
        modalPublicationDate = document.getElementById('modal-publication-date').textContent;
        modalIsbn = document.getElementById('modal-isbn').textContent;
        modalDateBorrowed = document.getElementById('modal-date-borrowed').textContent;
        modalDateReturned = document.getElementById('modal-date-returned').textContent;
        modalStatus = document.getElementById('modal-status').textContent;


        submitBtn = document.getElementById('submitBtn');
        submitBtnDataToggle = document.createAttribute("data-toggle");
        submitBtnDataTarget = document.createAttribute("data-target");
        submitBtnDataBackdrop = document.createAttribute("data-backdrop");
        submitBtnDataKeyboard = document.createAttribute("data-keyboard");
      //  submitBtnCheckout = document.createAttribute("value");


        submitBtnDataToggle.value = "modal";
        submitBtnDataTarget.value = "#myModal";
        submitBtnDataBackdrop.value = "static";
        submitBtnDataKeyboard.value = "false";
      //  submitBtnCheckout.value = "checkout";


        submitBtn.setAttributeNode(submitBtnDataToggle);
        submitBtn.setAttributeNode(submitBtnDataTarget);
        submitBtn.setAttributeNode(submitBtnDataBackdrop);
        submitBtn.setAttributeNode(submitBtnDataKeyboard);
      //  checkout.setAttributeNode(submitBtnCheckout);


        picture = document.getElementById('picture')
        modalTitle = document.getElementById('modal-title');
        modalAuthor = document.getElementById('modal-author');
        modalPublicationDate = document.getElementById('modal-publication-date');
        modalIsbn = document.getElementById('modal-isbn');
        modalDateBorrowed = document.getElementById('modal-date-borrowed');
        modalDateReturned = document.getElementById('modal-date-returned');
        modalStatus = document.getElementById('modal-status');


        bookPictureSrc = document.createAttribute("src");


        bookPictureSrc.value = "upload_resources/"+response.name;
        modalTitleText = document.createTextNode(response.title);
        modalAuthorText= document.createTextNode(response.author);
        modalDateBorrowedText = document.createTextNode(response.Date_borrowed);
        modalStatusText = document.createTextNode(response.status);
        modalIsbnText = document.createTextNode(response.isbn);
        modalPublicationDateText = document.createTextNode(response.publication_Date);
        modalDateReturnedText = document.createTextNode(response.Date_returned);


        picture.setAttributeNode(bookPictureSrc);
        modalTitle .appendChild(modalTitleText);
        modalAuthor.appendChild(modalAuthorText);
        modalPublicationDate.appendChild(modalPublicationDateText);
        modalIsbn.appendChild(modalIsbnText);
        modalDateBorrowed.appendChild(modalDateBorrowedText);
        modalDateReturned.appendChild(modalDateReturnedText);
        modalStatus.appendChild(modalStatusText);
      }
     }
  };
}

document.getElementById("checkout").addEventListener("click", function() {
  checkout = document.getElementById('checkout');
  submitBtnCheckout = document.createAttribute("value");
   submitBtnCheckout.value = "checkout";
   checkout.setAttributeNode(submitBtnCheckout);
   checkout_resources();
   });
   document.getElementById("isbn").addEventListener("keyup", function() {
              let isbnElement = isbnValue = isbnElementAtrClass = isbnElementAtrHref = isbnElementAtrPointer = displayIsbn = displayIsbn = showHoverAtrPointer= renewFinalIndex = "";
              let bookSearchTxt = document.getElementById('isbn').value;
              if(bookSearchTxt!==""){
                let xhttp = new XMLHttpRequest();
                xhttp.open("POST", "patron_checkout_submit.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("searchBook="+bookSearchTxt);
                xhttp.onreadystatechange = function() {
                if(this.readyState === 4 && this.status === 200){
                  let response = JSON.parse(this.responseText);

                  let isbnSize = response.length-1;
                  let indexSearchIsbn = 0;
                  if(document.getElementById('bookvalue').value != "" ){
                    let isbnParent = document.getElementById('show-isbn');
                    while (isbnParent.firstChild) {
                        isbnParent.removeChild(isbnParent.firstChild);
                    }
                  }
                if(response.No != "No"){

                  while(indexSearchIsbn <= isbnSize){
                      isbnElement = document.createElement("li");
                      isbnValue = document.createTextNode(response[indexSearchIsbn]);
                      isbnElement.appendChild(isbnValue);

                      isbnElementAtrClass = document.createAttribute("class");
                      isbnElementAtrPointer = document.createAttribute("class");
                      showHoverAtrPointer = document.createAttribute("class");

                      isbnElementAtrAction = document.createAttribute("onclick");


                      isbnElementAtrClass.value="list-group-item list-group-item-action border-1";
                      isbnElementAtrPointer.value="cursorIsbn";
                      showHoverAtrPointer.value="showHover";
                      isbnElementAtrAction.value="getClickedValue("+response[indexSearchIsbn]+")";

                      isbnElement.setAttributeNode(showHoverAtrPointer);
                      isbnElement.setAttributeNode(isbnElementAtrClass);
                      isbnElement.setAttributeNode(isbnElementAtrPointer);
                      isbnElement.setAttributeNode(isbnElementAtrAction);



                      displayIsbn = document.getElementById('show-isbn');
                      displayIsbn.appendChild(isbnElement);
                      indexSearchIsbn = indexSearchIsbn + 1;

                    }

                    let suggestIndex = document.createAttribute("value");
                    suggestIndex.value =  bookSearchTxt;
                    let suggestIndexId = document.getElementById('bookvalue');
                    suggestIndexId.setAttributeNode(suggestIndex);
                  } else{
                    let noIsbnElement = document.createElement("p");
                    let noIsbnText = document.createTextNode("No matching record");
                    let noIsbnAtr = document.createAttribute("class");
                      noIsbnAtr.value = "setError";
                    noIsbnElement.appendChild(noIsbnText);
                    noIsbnElement.setAttributeNode(noIsbnAtr);
                    displayIsbn = document.getElementById('show-isbn');
                    displayIsbn.appendChild(noIsbnElement);
                    }
                  }
              }
            }
      });

  function getClickedValue(res){
        document.getElementById('isbn').value = res;
        let isbnInvisibleAtr = document.createAttribute("hidden");
        document.getElementById('show-isbn').setAttributeNode(isbnInvisibleAtr);
      }

function renew_checkout(bookindex,rowIndex){
   let status="renew";
   let xhttp = new XMLHttpRequest();
  let isbn = document.getElementsByClassName('btn btn-success renewBtn')[bookindex].value;
   let passport_number = document.getElementById('passport_number').value;
  xhttp.open("POST", "patron_checkout_submit.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var emailSent = document.getElementById("emailSent").checked?"sendEmail":"";
  var checkout = document.getElementById('renewCheckout').value==="renew"?"renew":"";
  if(checkout==="renew"){
    xhttp.send("isbn="+isbn+"&status="+status+"&checkout="+checkout+"&emailSent="+emailSent);
  } else {
      xhttp.send("isbn="+isbn+"&status="+status+"&checkout="+checkout+"&emailSent="+emailSent);
  }
  xhttp.onreadystatechange = function() {
  if(this.readyState === 4 && this.status === 200){
       let response = JSON.parse(this.responseText);
       if(response.validate_isbn==="ONE"){
         let validateIsbn = document.getElementById('isbn_incorrect');
         let validateIsbnClass = document.createAttribute("class");
         validateIsbnClass.value = "glyphicon glyphicon-remove text-danger";
         validateIsbn.setAttributeNode(validateIsbnClass);
       }

       if(response.resources_borrowed==="TWO"){
         let resourcesBorrowed = document.getElementById('already_borrowed');
         let resourcesBorrowedClass = document.createAttribute("class");
         resourcesBorrowedClass.value = "glyphicon glyphicon-remove text-danger";
         resourcesBorrowed.setAttributeNode(resourcesBorrowedClass);
       }

       if(response.checkout_limit==="THREE"){
         let validateCheckoutLimit = document.getElementById('exceed_limit');
         let validateCheckoutLimitClass = document.createAttribute("class");
         validateCheckoutLimitClass.value = "glyphicon glyphicon-remove text-danger";
         validateCheckoutLimit.setAttributeNode(validateCheckoutLimitClass);
       }

       if(response.resource_available==="FOUR"){
         let validateResourceAvailable = document.getElementById('book_available');
         let resourceAvailableClass = document.createAttribute("class");
         resourceAvailableClass.value = "glyphicon glyphicon-remove text-danger";
         validateResourceAvailable.setAttributeNode(resourceAvailableClass);
       }

       if(response.due_return ==="FIVE"){
         let validateDueReturn = document.getElementById('due_return');
         let dueReturnClass = document.createAttribute("class");
         dueReturnClass.value = "glyphicon glyphicon-remove text-danger";
         validateDueReturn.setAttributeNode(dueReturnClass);
       }

     if(response.renew_status ==="renewed"){
      let renewBtn = document.getElementsByClassName('renewBtn');
        renewBtn[bookindex].remove();
       let finalCheckout = document.getElementById('renewCheckout');            // update
       finalCheckout.value = "effevtive";
     }
     if(response.checkoutMode ==="renewed_process"){
       let renewBtn = renewBtnDataToggle = renewBtnDataTarget = renewBtnDataBackdrop = renewBtnDataKeyboard = picture =
       modalTitle = modalAuthor = modalAuthor = modalPublicationDate = modalIsbn = modalDateBorrowed =  modalDateReturned =
       modalStatus = bookPictureSrc = modalTitleText = modalAuthorText = modalDateBorrowedText = modalDateBorrowedText =
       modalStatusText = modalIsbnText = modalPublicationDateText =checkout= modalDateReturnedText ="";

       document.getElementById('modal-title').textContent="";
       document.getElementById('modal-author').textContent="";
       document.getElementById('modal-publication-date').textContent="";
       document.getElementById('modal-isbn').textContent="";
       document.getElementById('modal-date-borrowed').textContent="";
       document.getElementById('modal-date-returned').textContent="";
       document.getElementById('modal-status').textContent="";

     //  checkout = document.getElementById('checkout');
       picture = document.getElementById('picture');
       modalTitle = document.getElementById('modal-title').textContent;
       modalAuthor = document.getElementById('modal-author').textContent;
       modalPublicationDate = document.getElementById('modal-publication-date').textContent;
       modalIsbn = document.getElementById('modal-isbn').textContent;
       modalDateBorrowed = document.getElementById('modal-date-borrowed').textContent;
       modalDateReturned = document.getElementById('modal-date-returned').textContent;
       modalStatus = document.getElementById('modal-status').textContent;


       renewBtnDataToggle = document.createAttribute("data-toggle");
       renewBtnDataTarget = document.createAttribute("data-target");
       renewBtnDataBackdrop = document.createAttribute("data-backdrop");
       renewBtnDataKeyboard = document.createAttribute("data-keyboard");
     //  submitBtnCheckout = document.createAttribute("value");


       renewBtnDataToggle.value = "modal";
       renewBtnDataTarget.value = "#myModal";
       renewBtnDataBackdrop.value = "static";
       renewBtnDataKeyboard.value = "false";
     //  submitBtnCheckout.value = "checkout";

       let renewBtnIndex = document.getElementsByClassName('btn btn-success renewBtn');
       renewBtnIndex[bookindex].setAttributeNode(renewBtnDataToggle);
       renewBtnIndex [bookindex].setAttributeNode(renewBtnDataTarget);
       renewBtnIndex[bookindex].setAttributeNode(renewBtnDataBackdrop);
       renewBtnIndex [bookindex].setAttributeNode(renewBtnDataKeyboard);
     //  checkout.setAttributeNode(submitBtnCheckout);


       picture = document.getElementById('picture');
       modalTitle = document.getElementById('modal-title');
       modalAuthor = document.getElementById('modal-author');
       modalPublicationDate = document.getElementById('modal-publication-date');
       modalIsbn = document.getElementById('modal-isbn');
       modalDateBorrowed = document.getElementById('modal-date-borrowed');
       modalDateReturned = document.getElementById('modal-date-returned');
       modalStatus = document.getElementById('modal-status');


       bookPictureSrc = document.createAttribute("src");


       bookPictureSrc.value = "upload_resources/"+response.name;
       modalTitleText = document.createTextNode(response.title);
       modalAuthorText= document.createTextNode(response.author);
       modalDateBorrowedText = document.createTextNode(response.Date_borrowed);
       modalStatusText = document.createTextNode(response.status);
       modalIsbnText = document.createTextNode(response.isbn);
       modalPublicationDateText = document.createTextNode(response.publication_Date);
       modalDateReturnedText = document.createTextNode(response.Date_returned);


       picture.setAttributeNode(bookPictureSrc);
       modalTitle .appendChild(modalTitleText);
       modalAuthor.appendChild(modalAuthorText);
       modalPublicationDate.appendChild(modalPublicationDateText);
       modalIsbn.appendChild(modalIsbnText);
       modalDateBorrowed.appendChild(modalDateBorrowedText);
       modalDateReturned.appendChild(modalDateReturnedText);
       modalStatus.appendChild(modalStatusText);

       document.getElementById('renewCheckout').style.display="block";
       document.getElementById('checkout').style.display="none";
       document.getElementById('checkin').style.display="none";
       document.getElementById('checkoutReserve').style.display="none";


       let renewIndexOne = document.createAttribute("value");
       renewIndexOne.value = bookindex ;
       let renewFinalIndex = document.getElementById('bookvalue');
       renewFinalIndex.setAttributeNode(renewIndexOne);

         let renewIndexTwo = document.createAttribute("value");
         renewIndexTwo.value = rowIndex;
         var renewBookIncrement = document.getElementById('bookincrement');
         renewBookIncrement.setAttributeNode(renewIndexTwo);


        }
     }
  };

}
document.getElementById("renewCheckout").addEventListener("click", function() {
  if(document.getElementById("renewCheckout").value ===""){
    submitBtnCheckout = document.createAttribute("value");
    submitBtnCheckout.value = "renew";
    let renewIndexOne = document.getElementById('bookvalue').value;
    let renewIndexTwo = document.getElementById('bookincrement').value;
    document.getElementById("renewCheckout").setAttributeNode(submitBtnCheckout);
    renew_checkout(renewIndexOne , renewIndexTwo );
  }
});

function resources_checkin(bookindex , rowIndex){
  let statusCheckin="checkin";
  let xhttpCheckin = new XMLHttpRequest();
 let isbnCheckin = document.getElementsByClassName('btn btn-danger checkinBtn')[bookindex].value;
 var passport_number = document.getElementById('passport_number').value;
 xhttpCheckin.open("POST", "patron_checkout_submit.php", true);
 xhttpCheckin.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 var emailSent = document.getElementById("emailSent").checked?"sendEmail":"";
 var checkin = document.getElementById('checkin').value==="checkin"?"checkin":"";
 if(checkin==="checkin"){
   xhttpCheckin.send("isbn="+isbnCheckin+"&status="+statusCheckin+"&checkout="+checkin+"&emailSent="+emailSent);
 } else {
   xhttpCheckin.send("isbn="+isbnCheckin+"&status="+statusCheckin+"&checkout="+checkin+"&emailSent="+emailSent);
 }
 xhttpCheckin.onreadystatechange = function() {
 if(this.readyState === 4 && this.status === 200){
      var response = JSON.parse(this.responseText);
      if(response.validate_isbn==="ONE"){
        let validateIsbn = document.getElementById('isbn_incorrect');
        let validateIsbnClass = document.createAttribute("class");
        validateIsbnClass.value = "glyphicon glyphicon-remove text-danger";
        validateIsbn.setAttributeNode(validateIsbnClass);
      }

    if(response.checkin_status ==="checkin"){
      let checkinData = document.getElementsByClassName('bookData');
      let checkinDataAtr = document.createAttribute("hidden");
      checkinData[rowIndex].setAttributeNode(checkinDataAtr);
      let anulCheckin = document.getElementById("checkin");
      anulCheckin.value = "";
      response.checkin_status = "";
    }
    if(response.checkinMode ==="checkin_process"){
      let checkinBtn =checkinBtnIndex = checkinBtnDataToggle = checkinBtnDataTarget = checkinBtnDataBackdrop = checkinBtnDataKeyboard = picture = modalHeader = modalTitle = modalAuthor = modalAuthor = modalPublicationDate = modalIsbn = modalDateBorrowed =  modalDateReturned = modalStatus = bookPictureSrc =modalHeaderText=
       modalTitleText = modalAuthorText = modalDateBorrowedText = modalDateBorrowedText = modalStatusText = modalIsbnText = modalPublicationDateText =checkout= modalDateReturnedText ="";

      document.getElementById('modal-title').textContent="";
      document.getElementById('modal-author').textContent="";
      document.getElementById('modal-publication-date').textContent="";
      document.getElementById('modal-isbn').textContent="";
      document.getElementById('modal-date-borrowed').textContent="";
      document.getElementById('modal-date-returned').textContent="";
      document.getElementById('modal-status').textContent="";
      document.getElementsByClassName('modal-title text-center').textContent = "Checkin";
    //  checkout = document.getElementById('checkout');
      picture = document.getElementById('picture');
      modalTitle = document.getElementById('modal-title').textContent;
      modalAuthor = document.getElementById('modal-author').textContent;
      modalPublicationDate = document.getElementById('modal-publication-date').textContent;
      modalIsbn = document.getElementById('modal-isbn').textContent;
      modalDateBorrowed = document.getElementById('modal-date-borrowed').textContent;
      modalDateReturned = document.getElementById('modal-date-returned').textContent;
      modalStatus = document.getElementById('modal-status').textContent;

      document.getElementById('checkin').style.display="block";
      document.getElementById('checkout').style.display="none";
      document.getElementById('renewCheckout').style.display="none";
      document.getElementById('checkoutReserve').style.display="none";



      checkinBtnDataToggle = document.createAttribute("data-toggle");
      checkinBtnDataTarget = document.createAttribute("data-target");
      checkinBtnDataBackdrop = document.createAttribute("data-backdrop");
      checkinBtnDataKeyboard = document.createAttribute("data-keyboard");


      checkinBtnDataToggle.value = "modal";
      checkinBtnDataTarget.value = "#myModal";
      checkinBtnDataBackdrop.value = "static";
      checkinBtnDataKeyboard.value = "false";


      checkinBtnIndex = document.getElementsByClassName('btn btn-danger');
      checkinBtnIndex[bookindex].setAttributeNode(checkinBtnDataToggle);
      checkinBtnIndex [bookindex].setAttributeNode(checkinBtnDataTarget);
      checkinBtnIndex[bookindex].setAttributeNode(checkinBtnDataBackdrop);
      checkinBtnIndex [bookindex].setAttributeNode(checkinBtnDataKeyboard);


      picture = document.getElementById('picture');
      modalTitle = document.getElementById('modal-title');
      modalAuthor = document.getElementById('modal-author');
      modalPublicationDate = document.getElementById('modal-publication-date');
      modalIsbn = document.getElementById('modal-isbn');
      modalDateBorrowed = document.getElementById('modal-date-borrowed');
      modalDateReturned = document.getElementById('modal-date-returned');
      modalStatus = document.getElementById('modal-status');


      bookPictureSrc = document.createAttribute("src");
      bookPictureSrc.value = "upload_resources/"+response.name;
      modalTitleText = document.createTextNode(response.title);
      modalAuthorText= document.createTextNode(response.author);
      modalDateBorrowedText = document.createTextNode(response.Date_borrowed);
      modalStatusText = document.createTextNode(response.status);
      modalIsbnText = document.createTextNode(response.isbn);
      modalPublicationDateText = document.createTextNode(response.publication_Date);
      modalDateReturnedText = document.createTextNode(response.Date_returned);


      picture.setAttributeNode(bookPictureSrc);
      modalTitle .appendChild(modalTitleText);
      modalAuthor.appendChild(modalAuthorText);
      modalPublicationDate.appendChild(modalPublicationDateText);
      modalIsbn.appendChild(modalIsbnText);
      modalDateBorrowed.appendChild(modalDateBorrowedText);
      modalDateReturned.appendChild(modalDateReturnedText);
      modalStatus.appendChild(modalStatusText);
      document.getElementById("checkin").innerHtml = "Checkin";
      var indexOne = document.createAttribute("value");
      indexOne.value = bookindex ;
      var finalIndex = document.getElementById('bookvalue');
      finalIndex.setAttributeNode(indexOne);

        var indexTwo = document.createAttribute("value");
        indexTwo.value = rowIndex ;
        var bookIncrement = document.getElementById('bookincrement');
        bookIncrement.setAttributeNode(indexTwo);

       }
    }
 };
}
document.getElementById("checkin").addEventListener("click", function() {
      let submitBtnCheckin = document.createAttribute("value");
      submitBtnCheckin.value = "checkin";
      var valueOne = document.getElementById('bookvalue').value;
      var valueTwo = document.getElementById('bookincrement').value;
      document.getElementById("checkin").setAttributeNode(submitBtnCheckin);
      resources_checkin(valueOne, valueTwo);
   });




 function checkout_reserved_resources(bookindex, rowIndex){
      let status="reserve";
      let xhttp = new XMLHttpRequest();
     let isbn = document.getElementsByClassName('btn btn-primary checkout')[bookindex].value;
      let  passport_number = document.getElementById('passport_number').value;
     xhttp.open("POST", "patron_checkout_submit.php", true);
     xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     var emailSent = document.getElementById("emailSent").checked?"sendEmail":"";
    let reserve = document.getElementById('checkout').value==="reserve"?"reserve":"";
     if(reserve==="reserve"){
       xhttp.send("isbn="+isbn+"&status="+status+"&checkout="+reserve+"&emailSent="+emailSent);
     } else {
       xhttp.send("isbn="+isbn+"&status="+status+"&checkout="+reserve+"&emailSent="+emailSent);
     }
     xhttp.onreadystatechange = function() {
     if(this.readyState === 4 && this.status === 200){
          var response = JSON.parse(this.responseText);
          if(response.validate_isbn==="ONE"){
            let validateIsbn = document.getElementById('isbn_incorrect');
            let validateIsbnClass = document.createAttribute("class");
            validateIsbnClass.value = "glyphicon glyphicon-remove text-danger";
            validateIsbn.setAttributeNode(validateIsbnClass);
          }

          if(response.resources_borrowed==="TWO"){
            let resourcesBorrowed = document.getElementById('already_borrowed');
            let resourcesBorrowedClass = document.createAttribute("class");
            resourcesBorrowedClass.value = "glyphicon glyphicon-remove text-danger";
            resourcesBorrowed.setAttributeNode(resourcesBorrowedClass);
          }

          if(response.checkout_limit==="THREE"){
            let validateCheckoutLimit = document.getElementById('exceed_limit');
            let validateCheckoutLimitClass = document.createAttribute("class");
            validateCheckoutLimitClass.value = "glyphicon glyphicon-remove text-danger";
            validateCheckoutLimit.setAttributeNode(validateCheckoutLimitClass);
          }

          if(response.resource_available==="FOUR"){
            let validateResourceAvailable = document.getElementById('book_available');
            let resourceAvailableClass = document.createAttribute("class");
            resourceAvailableClass.value = "glyphicon glyphicon-remove text-danger";
            validateResourceAvailable.setAttributeNode(resourceAvailableClass);
          }

          if(response.due_return ==="FIVE"){
            let validateDueReturn = document.getElementById('due_return');
            let dueReturnClass = document.createAttribute("class");
            dueReturnClass.value = "glyphicon glyphicon-remove text-danger";
            validateDueReturn.setAttributeNode(dueReturnClass);
          }

        if(response.checkout ==="checkout"){
          var tableRow = document.createElement("tr");
          var tableData1 = document.createElement("td");
          var tableData2 = document.createElement("td");
          var tableData3 = document.createElement("td");
          var tableData4 = document.createElement("td");
          var tableData5 = document.createElement("td");
          var tableData6 = document.createElement("td");
          let spaceBefore = document.createElement("br");

        var isbnData = document.createTextNode(response.isbn);
        var titleData = document.createTextNode(response.title);
        var authorData = document.createTextNode(response.author);
        var dateBorrowedData = document.createTextNode(response.Date_borrowed);
        var dueDateData = document.createTextNode(response.Due_Date);
        var statusData = document.createTextNode(response.status);


        tableData1.appendChild(isbnData);
        tableData2.appendChild(titleData);
        tableData3.appendChild(authorData);
        tableData4.appendChild(dateBorrowedData);
        tableData5.appendChild(dueDateData);
        tableData6.appendChild(statusData);


        tableRow.appendChild(tableData1);
        tableRow.appendChild(tableData2);
        tableRow.appendChild(tableData3);
        tableRow.appendChild(tableData4);
        tableRow.appendChild(tableData5);
        tableRow.appendChild(tableData6);
        tableRow.appendChild(spaceBefore);


        var element = document.getElementById('remove_resource');
        element.appendChild(tableRow);


        let renewBtn = document.createElement("button");
        let spaceElem = document.createElement("hr");
        let renewTxt = document.createTextNode("Renew");
        let renewClass = document.createAttribute("class");

        renewClass.value = "btn btn-success";

        renewBtn.appendChild(renewTxt);
        renewBtn.setAttributeNode(renewClass);
        tableRow.appendChild(renewBtn);

        tableRow.appendChild(spaceElem);


        let checkinBtn = document.createElement("button");
        let spaceElement = document.createElement("hr");
        let checkinTxt = document.createTextNode("check in");
        let checkinClass = document.createAttribute("class");

        checkinClass.value = "btn btn-danger";

        checkinBtn.appendChild(checkinTxt);
        checkinBtn.setAttributeNode(checkinClass);
        tableRow.appendChild(checkinBtn);
        let reserveData = document.getElementsByClassName('bookData');
        let reserveDataAtr = document.createAttribute("hidden");
        reserveData[rowIndex].setAttributeNode(reserveDataAtr);
         let anulReserve = document.getElementById("checkout");
         anulReserve.value = "";
        }
        if(response.checkoutMode ==="checkout_process"){
          let renewBtn = renewBtnDataToggle = renewBtnDataTarget = renewBtnDataBackdrop = renewBtnDataKeyboard = picture =
          modalTitle = modalAuthor = modalAuthor = modalPublicationDate = modalIsbn = modalDateBorrowed =  modalDateReturned =
          modalStatus = bookPictureSrc = modalTitleText = modalAuthorText = modalDateBorrowedText = modalDateBorrowedText =
          modalStatusText = modalIsbnText = modalPublicationDateText =checkout= modalDateReturnedText ="";
          document.getElementById('modal-title').textContent="";
          document.getElementById('modal-author').textContent="";
          document.getElementById('modal-publication-date').textContent="";
          document.getElementById('modal-isbn').textContent="";
          document.getElementById('modal-date-borrowed').textContent="";
          document.getElementById('modal-date-returned').textContent="";
          document.getElementById('modal-status').textContent="";


          picture = document.getElementById('picture');
          modalTitle = document.getElementById('modal-title').textContent;
          modalAuthor = document.getElementById('modal-author').textContent;
          modalPublicationDate = document.getElementById('modal-publication-date').textContent;
          modalIsbn = document.getElementById('modal-isbn').textContent;
          modalDateBorrowed = document.getElementById('modal-date-borrowed').textContent;
          modalDateReturned = document.getElementById('modal-date-returned').textContent;
          modalStatus = document.getElementById('modal-status').textContent;


          renewBtnDataToggle = document.createAttribute("data-toggle");
          renewBtnDataTarget = document.createAttribute("data-target");
          renewBtnDataBackdrop = document.createAttribute("data-backdrop");
          renewBtnDataKeyboard = document.createAttribute("data-keyboard");

        //  submitBtnCheckout = document.createAttribute("value");


          renewBtnDataToggle.value = "modal";
          renewBtnDataTarget.value = "#myModal";
          renewBtnDataBackdrop.value = "static";
          renewBtnDataKeyboard.value = "false";
        //  submitBtnCheckout.value = "checkout";


          var renewBtnIndex = document.getElementsByClassName('btn btn-primary checkout');
          renewBtnIndex[bookindex].setAttributeNode(renewBtnDataToggle);
          renewBtnIndex [bookindex].setAttributeNode(renewBtnDataTarget);
          renewBtnIndex[bookindex].setAttributeNode(renewBtnDataBackdrop);
          renewBtnIndex [bookindex].setAttributeNode(renewBtnDataKeyboard);
        //  checkout.setAttributeNode(submitBtnCheckout);


          picture = document.getElementById('picture');
          modalTitle = document.getElementById('modal-title');
          modalAuthor = document.getElementById('modal-author');
          modalPublicationDate = document.getElementById('modal-publication-date');
          modalIsbn = document.getElementById('modal-isbn');
          modalDateBorrowed = document.getElementById('modal-date-borrowed');
          modalDateReturned = document.getElementById('modal-date-returned');
          modalStatus = document.getElementById('modal-status');


          bookPictureSrc = document.createAttribute("src");


          bookPictureSrc.value = "upload_resources/"+response.name;
          modalTitleText = document.createTextNode(response.title);
          modalAuthorText= document.createTextNode(response.author);
          modalDateBorrowedText = document.createTextNode(response.Date_borrowed);
          modalStatusText = document.createTextNode(response.status);
          modalIsbnText = document.createTextNode(response.isbn);
          modalPublicationDateText = document.createTextNode(response.publication_Date);
          modalDateReturnedText = document.createTextNode(response.Date_returned);


          picture.setAttributeNode(bookPictureSrc);
          modalTitle .appendChild(modalTitleText);
          modalAuthor.appendChild(modalAuthorText);
          modalPublicationDate.appendChild(modalPublicationDateText);
          modalIsbn.appendChild(modalIsbnText);
          modalDateBorrowed.appendChild(modalDateBorrowedText);
          modalDateReturned.appendChild(modalDateReturnedText);
          modalStatus.appendChild(modalStatusText);

            document.getElementById('checkoutReserve').style.display="block";
          document.getElementById('checkout').style.display="none";
          document.getElementById('checkin').style.display="none";
          document.getElementById('renewCheckout').style.display="none";

          let reserveIndexOne = document.createAttribute("value");
          reserveIndexOne.value = bookindex ;
          let reserveFinalIndex = document.getElementById('bookvalue');
          reserveFinalIndex.setAttributeNode(reserveIndexOne);

            let reserveIndexTwo = document.createAttribute("value");
            reserveIndexTwo.value = rowIndex;
            var reserveBookIncrement = document.getElementById('bookincrement');
            reserveBookIncrement.setAttributeNode(reserveIndexTwo);
           }
        }
     };
   }
   document.getElementById("checkoutReserve").addEventListener("click", function() {
         submitBtnCheckout = document.createAttribute("value");
         submitBtnCheckout.value = "reserve";
         var reserveIndexOne = document.getElementById('bookvalue').value;
         var reserveIndexTwo = document.getElementById('bookincrement').value;
         document.getElementById("checkout").setAttributeNode(submitBtnCheckout);
         checkout_reserved_resources(reserveIndexOne, reserveIndexTwo);
      });
