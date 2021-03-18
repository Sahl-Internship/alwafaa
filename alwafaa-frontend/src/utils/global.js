import { i18n } from 'src/boot/i18n'

export const dateFormat = (timestamp) => {
  if (!timestamp) {
    return ''
  }

  const date = timestamp * 1000
  const day = new Date(date).getDate()

  const month = new Date(date)
    .toLocaleString('default', { month: 'short' })

  const year = new Date(date).getFullYear()

  return `${day}  ${i18n.t(`months.${month}`)}  ${year}`
}

// export const timeFormat = (timestamp) => {
//   if (!timestamp) {
//     return ''
//   }

//   const date = new Date(timestamp * 1000)
//   const hours = '0' + date.getHours()
//   // Minutes part from the timestamp
//   const minutes = '0' + date.getMinutes()
//   // Seconds part from the timestamp
//   const seconds = '0' + date.getSeconds()
//   return `${seconds} : ${minutes.substr(-2)} : ${hours}`
// }

export const calcDuration = (duration) => {
  if (!duration) {
    return '00:00:00'
  }

  const timeInHour = Math.floor(duration / 60)
  const hours = timeInHour.toString().length > 1
    ? timeInHour
    : `0${timeInHour}`
  const mins = (duration - (timeInHour * 60)).toString().length > 1
    ? duration - (timeInHour * 60)
    : `0${duration - (timeInHour * 60)}`
  return `${hours}:${mins}:00`
}
