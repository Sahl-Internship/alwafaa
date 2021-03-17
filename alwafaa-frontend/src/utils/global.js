import { i18n } from 'src/boot/i18n'

export const dateFormat = (timestamp) => {
  const date = timestamp * 1000
  const day = new Date(date).getDay()
  const month = new Date(date)
    .toLocaleString('default', { month: 'short' })
  const year = new Date(date).getFullYear()

  return `${day}  ${i18n.t(`months.${month}`)}  ${year}`
}

export const calcDuration = (duration) => {
  // const hours = (duration / 60).toString().length > 1
  //   ? duration / 60
  //   : `0${duration / 60}`

  // const mins = (duration - (hours * 60)).toString().length > 1
  //   ? duration - (hours * 60)
  //   : `0${duration - (hours * 60)}`

  // return `${hours}:${mins}:00`
  const timeInHour = Math.floor(duration / 60)
  const hours = timeInHour.toString().length > 1
    ? timeInHour
    : `0${timeInHour}`
  const mins = (duration - (timeInHour * 60)).toString().length > 1
    ? duration - (timeInHour * 60)
    : `0${duration - (timeInHour * 60)}`
  console.log(timeInHour)
  return `${hours}:${mins}:00`
}
