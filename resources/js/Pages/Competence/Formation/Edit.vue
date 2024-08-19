<template>
    
    <!-- Modal -->
   <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background: #2a2185; color: #fff;">
             <h5 class="modal-title" id="exampleModalLabel">Edition d'une formation</h5>
             <button type="button" class="close" @click="closeModal" style="color: #fff;">
               <span aria-hidden="true" style="color: #fff;">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form id="createForm" @submit.prevent="soumettre">
                <div class="form-group">
                   <label>Nom_Formation :</label>
                   <input v-model="editDirection.nom_formation" type="text" class="form-control" 
                   :class="{'is-invalid': editDirection.ErrorNom_formation != '' }" required/>
                   <span v-if="editDirection.ErrorNom_formation != '' " class="invalid-feedback error">{{ editDirection.ErrorNom_formation }}</span>
                </div>
                <div class="form-group">
                   <label>Organisme_Formation :</label>
                   <input v-model="editDirection.organisme_formation" type="text" class="form-control" required
                   :class="{'is-invalid': editDirection.ErrorOrganisme_formation != '' }"/>
                   <span v-if="editDirection.ErrorOrganisme_formation != '' " class="invalid-feedback error">{{ editDirection.ErrorOrganisme_formation }}</span>
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
       nom_formation: "",
       organisme_formation: "",
       description: "",
       ErrorNom_formation: "",
       ErrorDescription: "",
       ErrorOrganisme_formation: "",
   
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
       axios.get(route("formation.edit", { formation: props.directionId }))
       .then((response)=>{
           editDirection.id = response.data.formation.id
           editDirection.nom_formation = response.data.formation.nom_formation
           editDirection.organisme_formation = response.data.formation.organisme_formation
           editDirection.description = response.data.formation.description
       }).catch((error)=>{
           console.log(error)
       })
    }
    const formateError = ()=>{
         editDirection.ErrorNom_formation = ""
         editDirection.ErrorOrganisme_formation = ""
         editDirection.ErrorDescription = ""
    }
    const soumettre = ()=>{
     Inertia.put(route("formation.update", {formation: props.directionId}),
     {
       nom_formation: editDirection.nom_formation,
       organisme_formation: editDirection.organisme_formation,
       description: editDirection.description,
     },
     {
         onSuccess: (response)=>{
             useSwalSuccess("Formation mis á jours effectué")
             formateError()
             closeModal()
         },
         onError: (error)=>{
           if(error.nom_formation != null){
             editDirection.ErrorNom_formation = error.nom_formation
           }
           if(error.organisme_formation != null){
             editDirection.ErrorOrganisme_formation = error.organisme_formation
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