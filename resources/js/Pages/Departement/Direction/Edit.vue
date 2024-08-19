<template>
    
 <!-- Modal -->
<div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLabel">Édition d'une Direction</h5>
          <button type="button" class="close" @click="closeModal">
            <span aria-hidden="true" style="background: #2a2185; color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="createForm" @submit.prevent="soumettre">
             <div class="form-group">
                <label>Numero_direction :</label>
                <input v-model="editDirection.numero_direction" type="text" class="form-control" 
                :class="{'is-invalid': editDirection.ErrorNumero_direction != '' }" required/>
                <span v-if="editDirection.ErrorNumero_direction != '' " class="invalid-feedback error">{{ editDirection.ErrorNumero_direction }}</span>
             </div>
             <div class="form-group">
                <label>Responsable :</label>
                <input v-model="editDirection.responsable" type="text" class="form-control" required
                :class="{'is-invalid': editDirection.ErrorResponsable != '' }"/>
                <span v-if="editDirection.ErrorResponsable != '' " class="invalid-feedback error">{{ editDirection.ErrorResponsable }}</span>
             </div>
             <div class="form-group">
                <label>Titre :</label>
                <input v-model="editDirection.titre" type="text" class="form-control" required
                :class="{'is-invalid': editDirection.ErrorTitre != '' }"/>
                <span v-if="editDirection.ErrorTitre != '' " class="invalid-feedback error">{{ editDirection.ErrorTitre }}</span>
             </div>
             <div class="form-group">
                <label>Description :</label>
                <textarea v-model="editDirection.description" class="form-control"
                :class="{'is-invalid': editDirection.ErrorDescription != '' }">
              </textarea>
                <span v-if="editDirection.ErrorDescription != '' " class="invalid-feedback error">{{ editDirection.ErrorDescription }}</span>
             </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" @click="closeModal">Fermer</button>
          <button @click="soumettre" type="submit" class="btn btn-success">Soumettre</button>
        </div>
      </div>
    </div>
  </div>
</template>
<script></script>
<script setup>
import { reactive, watch, onMounted } from "vue"
import { Inertia } from "@inertiajs/inertia";
import { useSwalSuccess, useSwalError } from "../../../Composables/alert";

const emit = defineEmits(["modalClosed"])
let editModal = ""
onMounted(() => {
  editModal =  $("#EditModal")
})
 const props = defineProps({
    directionId: {
        type: Number,
        required: true
    },
    show: {
        type: Boolean,
        default: false
    }
 })
 const editDirection = reactive({
    id: "",
    numero_direction: "",
    responsable: "",
    titre: "",
    description: "",
    ErrorNumero_direction: "",
    ErrorDescription: "",
    ErrorResponsable: "",
    ErrorTitre: "",

 })
 const openModal = ()=>{
  editModal.modal("show")
  getDirectionById()
 }

 const closeModal = ()=>{
  editModal.modal("hide")
  emit("modalClosed")
  formateError()
 }
 const getDirectionById = ()=>{
    axios.get(route("direction.edit", { direction: props.directionId }))
    .then((response)=>{
        editDirection.id = response.data.direction.id
        editDirection.numero_direction = response.data.direction.numero_direction
        editDirection.responsable = response.data.direction.responsable
        editDirection.titre = response.data.direction.titre
        editDirection.description = response.data.direction.description
    }).catch((error)=>{
        console.log(error)
    })
 }
 const formateError = ()=>{
      editDirection.ErrorNumero_direction = ""
      editDirection.ErrorResponsable = ""
      editDirection.ErrorTitre = ""
      editDirection.ErrorDescription = ""
 }
 const soumettre = ()=>{
  Inertia.put(route("direction.update", {direction: props.directionId}),
  {
    numero_direction: editDirection.numero_direction,
    responsable: editDirection.responsable,
    titre: editDirection.titre,
    description: editDirection.description,
  },
  {
      onSuccess: (response)=>{
          useSwalSuccess("Direction mis á jours effectué")
          formateError()
          closeModal()
      },
      onError: (error)=>{
        if(error.numero_direction != null){
          editDirection.ErrorNumero_direction = error.numero_direction
        }
        if(error.titre != null){
          editDirection.ErrorTitre = error.titre
        }
        if(error.responsable != null){
          editDirection.ErrorResponsable = error.responsable
        }
        if(error.description != null){
          editDirection.ErrorDescription = error.description
        }
        
          useSwalError("Une erreur s'est produite :)")
      }
      
  }
  )
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