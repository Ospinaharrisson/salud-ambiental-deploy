const dayTimeIconPath = '/assets/images/user/Content/Bulletin/TodayForecast/dayTime-icon/';
const configLocal = { hour: '2-digit', minute: '2-digit', second: '2-digit' };
const configDate = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };

const dayTimeConfig = [
  { start: 6,  end: 12, icon: 'morning-icon.png',   message: 'Buenos días', background: 'bg-morning' },
  { start: 12, end: 18, icon: 'afternoon-icon.png', message: 'Buenas tardes', background: 'bg-afternoon' },
  { start: 18, end: 20, icon: 'night-icon.png',     message: 'Buenas noches', background: 'bg-night' },
  { start: 20, end: 24, icon: 'night-icon-2.png',   message: 'Buenas noches', background: 'bg-night-2' },
  { start: 0,  end: 3,  icon: 'dawn-icon.png',      message: 'Es madrugada',  background: 'bg-dawn' },
  { start: 3,  end: 6,  icon: 'dawn-icon.png',      message: 'Es madrugada',  background: 'bg-dawn-2' }
];

const weatherBackgroundMap = [
  { condition: 'drizzle', background: 'bg-rain' },
  { condition: 'rain', background: 'bg-rain' },
  { condition: 'thunderstorm', background: 'bg-rain' },
  // { condition: 'clouds', background: 'bg-clouds' },
];

let currentBucket = null;

function getBucketForHour(hour) {
  return dayTimeConfig.find(c => hour >= c.start && hour < c.end) || dayTimeConfig[3];
}

function updateDaytimeInfo() {
  const todayForecast = document.getElementById('todayForecast');
  const daytimeIcon = document.getElementById('daytime-icon');
  const daytimeMessage = document.getElementById('daytime-message');
  const daytimeHour = document.getElementById('daytime-hour');
  const daytimeCalendar = document.getElementById('daytime-calendar');

  const now = new Date();
  const hour = now.getHours();
  const bucket = getBucketForHour(hour);

  if (bucket && bucket !== currentBucket) {
    if (daytimeIcon) {
      daytimeIcon.src = dayTimeIconPath + bucket.icon;
      daytimeIcon.alt = bucket.message;
    }
    if (daytimeMessage) {
      daytimeMessage.textContent = bucket.message;
    }
    if (todayForecast) {
      todayForecast.className = 'bg-forecast ' + bucket.background;
    }
    currentBucket = bucket;
  }

  if (daytimeHour) {
    daytimeHour.innerText = now.toLocaleTimeString(configLocal);
  }

  if (daytimeCalendar) {
    daytimeCalendar.textContent = now.toLocaleDateString('es-ES', configDate);
  }
}

function updateDaytimeWeather() {
  const API_KEY = '64f60853740a1ee3ba20d0fb595c97d5';
  const CITY = 'Bogotá';
  const UNITS = 'metric';

  const weatherDesc = document.getElementById('weather-description');
  const weatherIcon = document.getElementById('weather-icon');
  const tempNow = document.getElementById('temp-now');
  const tempMin = document.getElementById('temp-min');
  const tempMax = document.getElementById('temp-max');
  const todayForecast = document.getElementById('todayForecast');
  const weatherFeelslike = document.getElementById('weather-feelslike');
  const weatherHumidity = document.getElementById('weather-humidity');
  const weatherWind = document.getElementById('weather-wind');
  const weatherPressure = document.getElementById('weather-pressure');

  fetch(`https://api.openweathermap.org/data/2.5/weather?q=${CITY}&appid=${API_KEY}&units=${UNITS}&lang=es`)
    .then(res => res.json())
    .then(data => {
      if (!data.weather?.[0] || !data.main) return;

      const desc = data.weather[0].description;
      const iconCode = data.weather[0].icon;
      const weatherCondition = data.weather[0].main.toLowerCase();

      if (weatherDesc) weatherDesc.textContent = desc;

      if (weatherIcon) {
        weatherIcon.src = `https://openweathermap.org/img/wn/${iconCode}@4x.png`;
        weatherIcon.alt = desc;
      }

      if (tempNow) tempNow.textContent = `${Math.round(data.main.temp)}°C`;
      if (tempMin) tempMin.textContent = `Min: ${data.main.temp_min}°C`;
      if (tempMax) tempMax.textContent = `Max: ${data.main.temp_max}°C`;

      if (todayForecast) {
        const found = weatherBackgroundMap.find(c => weatherCondition.includes(c.condition));
        if (found) {
          todayForecast.className = 'bg-forecast ' + found.background;
        }
      }

      if (weatherFeelslike) weatherFeelslike.textContent = `${Math.round(data.main.feels_like)}°C`;
      if (weatherHumidity) weatherHumidity.textContent = `${data.main.humidity}%`;
      if (weatherWind) weatherWind.textContent = `${data.wind.speed} m/s`;
      if (weatherPressure) weatherPressure.textContent = `${data.main.pressure} hPa`;
    })
    .catch(err => {
      console.error('Error al obtener el clima:', err);
    });
}

document.addEventListener('DOMContentLoaded', function () {
  updateDaytimeInfo();
  updateDaytimeWeather();
  setInterval(updateDaytimeInfo, 1000);
  setInterval(updateDaytimeWeather, 10 * 60 * 1000);
});
