export default function () {
  return {
    user: null,
    token: null || localStorage.getItem("token"),
  };
}
