<template>
  <div class="cardBox">
    <div class="carde mb-3" :key="test.id" v-for="test in editDirection.nombre">
        <div>
            <div class="numbers">{{ test.employer_count }}</div>
            <div class="cardName">{{ test.titre }}</div>
        </div>
        <div class="iconBx">
            <i class="fa fa-eye"></i>
        </div>
    </div>
</div>
</template>   
<script setup>
import { reactive, watch, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";

const emit = defineEmits(["modalClosed"])
let editModal = ""
onMounted(() => {
  editModal =  $("#cardBox")
})

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
})

const editDirection = reactive({
    nom: "",
    nombre: "",

 })

const openModal = ()=>{
  editModal.modal("hide")
  getDirectionById()
 }

 const closeModal = ()=>{
  emit("modalClosed")
  //formateError()
 }

 const getDirectionById = ()=>{
    axios.get(route("card"))
    .then((response)=>{
        editDirection.nom = response.data.employers.titre
        editDirection.nombre = response.data.employers
    }).catch((error)=>{
        console.log(error)
    })
 }

 watch(
  () => props.show,
  (newVal, oldVal) =>{
    if(newVal){
      openModal()
    }else{
      closeModal()
    }
  }
 )
</script>
