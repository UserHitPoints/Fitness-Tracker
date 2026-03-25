const  DB_name = "FitnessTracker";
const  DB_version = 1;
let db;     //db undefined will be filled later on

const requestdb = indexedDB.open(DB_name, DB_version);      //fires on first creation or when version number is manually increased

requestdb.onupgradeneeded = (event) => {        //ony fired when db is created if fired increment by 1
  const db = event.target.result;               // event.target is request .result is opened DB
  const objectStore = db.createObjectStore("workouts", { keyPath: "id", autoIncrement : true });        //creates objectStore w/ name "workouts" meta data : KeyPath ("id") autoIncrement is true
};

requestdb.onerror = (event) => {
  console.error("indexedDB fehler:",event.target.error);
};
requestdb.onsuccess = (event) => {      //if created succ. saves event..result in db (global var)
  db = event.target.result;
  console.log("IndexedDB bereit")
};

objectStore.createIndex("name", "name", { unique: false });  //xxx?
objectStore.createIndex("email", "email", { unique: true }); //xxx?

function saveOffline(uebung,gewicht,wiederholungen) {
    const transaction = db.transaction(["workouts"], "readwrite");      //canal to workouts read and write permissions
    const store = transaction.objectStore("workouts");          // stores object form transaction acts as paralell

    store.add({     //add following objects to store
        uebung : uebung,
        gewicht: gewicht,
        wiederholungen : wiederholungen,
        datum: new Date().toISOString().split("T")[0],      // new Date() = date form today ToIsoString converts date into Iso Format (readability fpor backend) split("t") splits date from time (1 array 2 objects) [0] date index -> 0
        synced: false       // to check if data has been synced with live db 
    })
}


function SyncData() {
    if (!navigator.onLine) return; // navigator = objects with infos about browser/ .online = bool 

    const transaction = db.transaction("workouts", "readonly");      //transaction open with readonly no inputs
    const store = tx.objectStore("workouts");       //stores from transaction
    const request = store.getAll();     //req all objects from store

    request.onsuccess = (event) => {        //fires wehen req -> succ. 
    const workouts = request.result.filter(synced => !synced.synced);       // filter through workouts for false synced objects 
    
}
}