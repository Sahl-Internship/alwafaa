import { axios } from "src/boot/axios";

export const handleLogin = (userData) => {
  console.log(userData);
  return axios.post("http://endpoints.alwafaa.localhost/site/login", userData);
};
// export const handleSignup = (userData) => {
export const handleSignup = (data) => {
  return axios({
    url: "http://endpoints.alwafaa.localhost/signup",
    method: "POST",
    data,
  });
};
