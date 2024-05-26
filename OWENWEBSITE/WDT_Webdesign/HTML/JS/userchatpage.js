let dataStore = {};

let user = "user1";
let partcipant = "";

let refreshTimer = 0;

async function getPsychologist() {
  let result = await fetch("Php/websrv.php?action=get_psychologist");
  result = await result.json();
  return result;
}

async function getActiveChat() {
  let result = await fetch(`Php/websrv.php?action=get_activechat&user=${user}`);
  result = await result.json();
  let activeList = document.getElementById("activechat");
  activeList.innerHTML = "";
  result.forEach((i) => {
    let psychoData = dataStore.psychologist.find((j) => j.user_id === i);
    if (typeof psychoData === "undefined")
      psychoData = { photo: "notfound.png", name: i };
    let chatListItem = document.createElement("DIV");
    chatListItem.innerHTML = `<img src="../HTML/Picture/${psychoData.photo}"/><div>${psychoData.name}</div>`;
    chatListItem.addEventListener(
      "click",
      () => ((partcipant = i), loadChat())
    );
    activeList.appendChild(chatListItem);
  });
  return result;
}

async function loadChat() {
  let result = await fetch(
    `Php/websrv.php?action=get_messages&user=${user}&participant=${partcipant}`
  );
  result = await result.json();
  let psychoData = dataStore.psychologist.find((j) => j.user_id === partcipant);
  if (typeof psychoData === "undefined")
    psychoData = { photo: "notfound.png", name: partcipant };
  let container = document.getElementById("currentchat");
  container.innerHTML = "";
  result.forEach((i) => {
    let chatmessage = document.createElement("DIV");
    let isMyMessage = i.msg_from === user;
    chatmessage.className = isMyMessage ? "mymsg" : "";
    chatmessage.innerHTML = `<div>${
      isMyMessage ? "You" : psychoData.name
    }</div>${i.message}<div></div><div>${i.msg_date}</div>`;
    container.appendChild(chatmessage);
  });
  container.scrollTop = container.clientHeight + 100;
}

async function sendMessage() {
  let textBox = document.forms["chatboxform"]["message"];
  let message = textBox.value;
  if (!message) return;
  let formData = new FormData();
  formData.append("message", message);
  let result = await fetch(
    `Php/websrv.php?action=send_message&user=${user}&recipient=${partcipant}`,
    {
      method: "POST",
      body: formData,
    }
  );
  result = await result.json();
  textBox.value = "";
}

async function login() {
  let testloginDiv = document.getElementById("testlogin");
  let loginform = document.forms["loginform"];
  user = loginform["username"].value;
  if (user==user) {
    openChat();
  } else {
    new FormData();
  }
  testloginDiv.style.display = "none";
}

async function onload() {
  let result = await getPsychologist();
  dataStore["psychologist"] = result;
  let container = document.getElementById("psychobox");
  container.innerHTML = "";
  result.forEach((i) => {
    let psychoblock = document.createElement("DIV");
    psychoblock.innerHTML = `<img src="../HTML/Picture/${i.photo}"/><div class="descblock"><div class="name">${i.name}</div><div class="desc">${i.description}</div></div>`;
    psychoblock.addEventListener("click", function () {
      partcipant = i.user_id;
      openChat();
    });
    container.appendChild(psychoblock);
  });
}

async function openChat() {
  let container = document.getElementById("psychobox");
  let chatbox = document.getElementById("chatbox");
  container.classList.remove("active");
  chatbox.classList.add("active");
  await getActiveChat();
  if (partcipant) loadChat();

  refreshTimer = setInterval(async () => {
    await getActiveChat();
    if (partcipant) loadChat();
  }, 2000);
}

function goback() {
  clearTimeout(refreshTimer);
  let container = document.getElementById("psychobox");
  let chatbox = document.getElementById("chatbox");
  chatbox.classList.remove("active");
  container.classList.add("active");
  onload();
}


