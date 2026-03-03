import axios from "axios";

const csrfStore = window.CSRF;

console.log(window.CSRF);

axios.interceptors.request.use((config) => {
  // Make sure headers exist
  if (!config.headers) {
    config.headers = new axios.AxiosHeaders();
  }

  // Use `set` to add the CSRF token
  if ('set' in config.headers) {
    config.headers.set(csrfStore.name, csrfStore.value);
  }

  return config;
})
