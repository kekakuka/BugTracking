var newTest = document.getElementById("newT");
var currentTest = document.getElementById("currentT");
var enterBug = document.getElementById("enterBug");
var ifNewTest = document.getElementById("ifNewTest");


function check() {
    if (ifNewTest.value === '1') {
        enterBug.style.display = 'block';
        newTest.style.display = 'block';
        currentTest.style.display = 'none';
    }
    else if (ifNewTest.value === '2') {
        enterBug.style.display = 'block';
        newTest.style.display = 'none';
        currentTest.style.display = 'block';
    }
    else {
        enterBug.style.display = 'none';
        newTest.style.display = 'block';
        currentTest.style.display = 'none';
    }

}

function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}



