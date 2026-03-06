<template>
    <nav class="flex gap-2">
    <button @click="themeColor1" type="button">
        <Badge size="small" value="" severity="info"></Badge>
    </button>
  
    <button @click="themeColor2" type="button" >
         <Badge size="small" value="" severity="warn"></Badge>
    </button>
   
    <button @click="themeColor3" type="button">
           <Badge size="small" value="" severity="danger"></Badge>
    </button>  

    <button @click="themeColor4" type="button">
           <Badge size="small" value="" class="!bg-pink-500"></Badge>
    </button>  

    <button @click="themeColor5" type="button">
           <Badge size="small" value="" class="!bg-teal-500"></Badge>
    </button>  
    <button @click="themeColor6" type="button">
           <Badge size="small" value="" class="!bg-gray-800"></Badge>
    </button>  

    
      
  
    </nav>

</template>

<script setup>
import Badge from "primevue/badge";
import OverlayBadge from "primevue/overlaybadge";
import { useColor } from "@/Composables/useColor";

const { themeColor1, themeColor2, themeColor3,  themeColor4, themeColor5,themeColor6, colorDefault } = useColor();
</script>
