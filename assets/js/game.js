let gunsBtn = document.getElementById('guns');
let infoBulle = `Je suspect <span class="x"></span> et <span class="y"></span> de detenir des marchandises illicites...`;
let infoBulle2 = `Haut les mains <span class="x"></span>, je sais que tu vends de la <span class="data"></span> il ne faut pas etre mechant...`;

let arrayPersoX = ['Ned Kelly', 'Billy the Kid', 'Butch Cassidy', 'Black Bart'];
let arrayPersoY = ['Butch Cassidy', 'Black Bart', 'Ned Kelly', 'Billy the Kid'];
let arrayData = ['cocaïne', 'heroin', 'meth', 'weed'];

// document.getElementById('ok').style.display = 'none';
//
// gunsBtn.addEventListener('click', function() {
//     arrayPersoX.forEach((perso, index) => {
//         console.log('guns clicked');
//         document.getElementById('info').innerHTML = infoBulle;
//         document.querySelector('#info-bulle span.x').innerHTML = perso;
//         document.querySelector('#info-bulle span.y').innerHTML = arrayPersoY[index];
//
//         document.getElementById('guns').style.display = 'none';
//
//         document.getElementById('info-bulle').innerHTML = infoBulle2;
//         document.querySelector('#info-bulle span.x').innerHTML = perso;
//
//
//         document.getElementById('ok').style.display = 'block';
//     })
// });

document.querySelector('#info-bulle span.x').innerHTML = arrayPersoX[0];
document.querySelector('#info-bulle span.y').innerHTML = arrayPersoY[0];

gunsBtn.addEventListener('click', () => {
    console.log('guns clicked');
    document.getElementById('guns').style.display = 'none';
    document.getElementById('info-bulle').innerHTML = infoBulle2;
    document.querySelector('#info-bulle span.x').innerHTML = arrayPersoX[0];
    document.querySelector('#info-bulle span.data').innerHTML = arrayData[0];
    document.getElementById('nb').style.display = 'block';
    document.getElementById('ok').style.display = 'block';
});
