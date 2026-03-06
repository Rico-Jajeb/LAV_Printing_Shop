import { ref, watch } from 'vue'

const savedColor = localStorage.getItem('themeColor') || 'red'
const colorDefault = ref(savedColor)

export function useColor() {

  function themeColor1() {
    colorDefault.value = 'blue'
  }

  function themeColor2() {
    colorDefault.value = 'yellow'
  }

  function themeColor3() {
    colorDefault.value = 'red'
  }

  function themeColor4() {
    colorDefault.value = 'pink'
  }
  function themeColor5() {
    colorDefault.value = 'teal'
  }
  function themeColor6() {
    colorDefault.value = 'black'
  }

  watch(colorDefault, (newColor) => {
    localStorage.setItem('themeColor', newColor)
  })

  return {
    themeColor1,
    themeColor2,
    themeColor3,
    themeColor4,
    themeColor5,
    themeColor6,
    colorDefault
  }
}