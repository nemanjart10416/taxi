const data = {};
const locations = ["Viena", "Aigen", "Bratislava"];
const postNumbers = ["9982", "4441", "3319"];
const streets = ["siebenbrunengasse", "ketzergasse"];

const optionsData = {
  locations: [
    "Viena",
    "Aigen",
    "Bratislava",
    "Viena",
    "Aigen",

    "Achau",
    "Aigen",
    "Altenberg",
    "Altlengbach",
    "Amstetten",
    "Andau",
    "Apetlon",
    "Arbesthal",
    "Au am Leithaberge",
    "Bad Fischau-Brunn",
    "Bad Sauerbrunn",
    "Bad Vöslau",
    "Bad Waltersdorf",
    "Baden",
    "Berndorf",
    "Biedermannsdorf",
    "Bisamberg",
    "Bockfliess",
    "Bratislava",
    "Breitenau",
    "Breitenbrunn",
    "Breitenfurt bei Wien",
    "Bruck a.d.Leitha",
    "Bruckneudorf",
    "Brunn a. Gebirge",
    "Deutsch Jahrndorf",
    "Deutsch Wagram",
    "Donnerskirchen",
    "Ebergassing",
    "Ebreichsdorf",
    "Edelstal",
    "Eggenburg",
    "Eggendorf",
    "Eichgraben",
    "Eisenstadt",
    "Enzenreith",
    "Enzersfeld",
    "Enzesfeld-Lindabrunn",
    "Felixdorf",
    "Fischamend",
    "Frauenkirchen",
    "Freundorf",
    "Gaaden",
    "Gablitz",
    "Gars am Kamp",
    "Gattendorf",
    "Gerasdorf b.Wien",
    "Gießhübl",
    "Gloggnitz",
    "Gols",
    "Gramatneusiedl",
    "Graz",
    "Gross-Enzersdorf",
    "Grossebersdorf",
    "Grossrussbach",
    "Gumpoldskirchen",
    "Guntramsdorf",
    "Günselsdorf",
    "Gänserndorf",
    "Göttlesbrunn",
    "Götzendorf",
    "Götzendorf an der Leitha",
    "Hagenbrunn",
    "Halbturn",
    "Hamburg",
    "Hargelsberg",
    "Hautzendorf",
    "Heiligenkreuz",
    "Hennersdorf",
    "Himberg",
    "Hinterbrühl",
    "Hof bei Salzburg",
    "Hofstetten",
    "Hollabrunn",
    "Hornstein",
    "Ilmitz",
    "Jois",
    "Kaltenleutgeben",
    "Katzelsdorf",
    "Kittsee",
    "Klein-Neusiedl",
    "Klosterneuburg",
    "Kobersdorf",
    "Korneuburg",
    "Kottingbrunn",
    "Krems An Der Donau",
    "Kreuzstetten",
    "Kritzendorf",
    "Königstetten",
    "Laab Im Walde",
    "Langenlois",
    "Langenzersdorf",
    "Lanzendorf",
    "Lanzenkirchen",
    "Lassee",
    "Laxenburg",
    "Leibnitz",
    "Leoben",
    "Leobendorf",
    "Leobersdorf",
    "Leopoldsdorf",
    "Linz",
    "Manhartsbrunn",
    "Mannersdorf am Leithagebirge",
    "Mannswörth",
    "Margarethen am Moos",
    "Maria Anzbach",
    "Maria Ellend",
    "Maria Enzersdorf",
    "Maria Lanzendorf",
    "Matzendorf-Hölles",
    "Mauerbach",
    "Mautern An Der Donau",
    "Melk",
    "Mistelbach",
    "Münchendorf",
    "Mödling",
    "Mönchhof",
    "Natschbach-Loipersbach",
    "Neudorf",
    "Neudörfl",
    "Neulengbach",
    "Neunkirchen",
    "Neusiedl am See",
    "Nickelsdorf",
    "Niederkreuzstetten",
    "Oberwaltersdorf",
    "Oevnhausen",
    "Ollern",
    "Pama",
    "Pamhagen",
    "Parndorf",
    "Pellendorf",
    "Perchtoldsdorf",
    "Petronell-Carnuntum",
    "Pfaffstätten",
    "Pillichsdorf",
    "Pinkafeld",
    "Pitten",
    "Podersdorf am See",
    "Pottendorf",
    "Pottenstein",
    "Potzneusiedi",
    "Pressbaum",
    "Probstdorf",
    "Prottes",
    "Puch bei Weiz",
    "Purbach",
    "Purkersdorf",
    "Raasdorf",
    "Rauchenwarth",
    "Reickersdorf",
    "Reisenberg",
    "Robrau",
    "Rohrendorf Bei Krems",
    "Rottenmann",
    "Rust",
    "Salzburg",
    "Sankt Andrä am Zicksee",
    "Sankt Veit an der Glan",
    "Schattendorf",
    "Schwadorf",
    "Schwechat",
    "Schönau An Der Triesting",
    "Schönkirchen",
    "Semmering",
    "Sieghartskirchen",
    "Sittendorf",
    "Sollenau",
    "Sooss",
    "Spillern",
    "St. Andrä am Zicksee",
    "St.Andrä-Wördern",
    "St.Pölten",
    "St. Pölten",
    "Steinbrunn",
    "Stettenhof",
    "Stiefern",
    "Stockerau",
    "Strasshof An Der Nordbahn",
    "Sulz im Wienerwald",
    "Tadten",
    "Tattendorf",
    "Ternitz",
    "Theresienfeld",
    "Thürnthal",
    "Traiskirchen",
    "Trumau",
    "Tulbingerkogel",
    "Tulln An Der Donau",
    "Tullnerbach",
    "Ulrichskirchen-Schleinbach",
    "Unterolberndorf",
    "Unterwaltersdorf",
    "Velm",
    "Vosendorf",
    "Wallern im Burgenland",
    "Walpersdorf",
    "Weiden am See",
    "Weidling",
    "Weigelsdorf",
    "Weikendorf",
    "Weikersdorf Am Steinfelde",
    "Wien",
    "Wiener Neudorf",
    "Wiener Neustadt",
    "Winden am See",
    "Wolfsgraben",
    "Wolkersdorf Im Weinviertel",
    "Würflach",
    "Wöllersdorf-Steinbrück",
    "Wösendorf",
    "Zurndorf",
  ],
  postalNumbers: ["9982", "4441", "3319"],
  gender: ["Mr", "Ms"],
  paymentMethod: ["cash", "credit card"],
};

const picker = datepicker(".date-picker", {
  formatter: (input, date, instance) => {
    const value = date.toLocaleDateString();
    input.value = value; // => '1/1/2099'
    data.encounterDate = value;
  },
});

const picker1 = datepicker(".date-picker1", {
  formatter: (input, date, instance) => {
    const value = date.toLocaleDateString();
    input.value = value; // => '1/1/2099'
    data.encounterDateOfReturnFlight = value;
  },
});

document.querySelector(".additionalInfo").style.display = "none";

for (const el of document.getElementsByClassName("hasDynamicNumericValues")) {
  const attribute = el.getAttribute("id");
  const numericAmount = el.getAttribute("data-value");
  for (let i = 0; i < numericAmount; i++) {
    document.querySelector(
      "#" + attribute
    ).innerHTML += `<option value='${i}'>${i}</option>`;
  }
  document
    .querySelector("#" + attribute)
    .addEventListener("change", function (e) {
      data[attribute] = this.value;
    });
}

for (const el of document.getElementsByClassName("hasDynamicOptionsArray")) {
  const attribute = el.getAttribute("id");
  for (let i = 0; i < optionsData[attribute].length; i++) {
    document.querySelector(
      "#" + attribute
    ).innerHTML += `<option value='${optionsData[attribute][i]}'>${optionsData[attribute][i]}</option>`;
  }
  document
    .querySelector("#" + attribute)
    .addEventListener("change", function (e) {
      data[attribute] = this.value;
    });
}

for (const el of document.getElementsByClassName("hasDynamicInputFields")) {
  const attribute = el.getAttribute("id");
  document
    .querySelector("#" + attribute)
    .addEventListener("input", function (e) {
      data[attribute] = this.value;
    });
}

for (const el of document.getElementsByClassName(
  "hasDynamicRadioButtonGroup"
)) {
  el.addEventListener("click", function (e) {
    data.hasReturnFlight = this.value;
    document.querySelector(".additionalInfo").style.display =
      el.getAttribute("value") === "yes" ? "block" : "none";
  });
}

document.querySelector(".submit").addEventListener("click", function (e) {
  e.preventDefault();
  document.querySelector(".agreementCheckbox").checked && console.log(data);
});
