<template>
    
    <!-- Modal -->
   <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background: #2a2185; color: #fff;">
             <h5 class="modal-title" id="exampleModalLabel">Édition d'un corps</h5>
             <button type="button" class="close" @click="closeModal">
               <span aria-hidden="true" style="background: #2a2185; color: #fff;">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form id="createForm" @submit.prevent="soumettre">
                <div class="form-group">
                   <label>Numero_Corps :</label>
                   <input v-model="editDirection.numero_corps" type="text" class="form-control" 
                   :class="{'is-invalid': editDirection.ErrorNumero_corps != '' }" required/>
                   <span v-if="editDirection.ErrorNumero_corps != '' " class="invalid-feedback error">{{ editDirection.ErrorNumero_corps }}</span>
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
       numero_corps: "",
       titre: "",
       description: "",
       ErrorNumero_corps: "",
       ErrorDescription: "",
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
       axios.get(route("corps.edit", { corps: props.directionId }))
       .then((response)=>{
           editDirection.id = response.data.corps.id
           editDirection.numero_corps = response.data.corps.numero_corps
           editDirection.titre = response.data.corps.titre
           editDirection.description = response.data.corps.description
       }).catch((error)=>{
           console.log(error)
       })
    }
    const formateError = ()=>{
         editDirection.ErrorNumero_grade = ""
         editDirection.ErrorTitre = ""
         editDirection.ErrorDescription = ""
    }
    const soumettre = ()=>{
     Inertia.put(route("corps.update", {corps: props.directionId}),
     {
       numero_corps: editDirection.numero_corps,
       titre: editDirection.titre,
       description: editDirection.description,
     },
     {
         onSuccess: (response)=>{
             useSwalSuccess("Corps mis á jours effectué")
             formateError()
             closeModal()
         },
         onError: (error)=>{
           if(error.numero_corps != null){
             editDirection.ErrorNumero_corps = error.numero_corps
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