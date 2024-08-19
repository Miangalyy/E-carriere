<template>
    
    <!-- Modal -->
   <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background: #2a2185; color: #fff;">
             <h5 class="modal-title" id="exampleModalLabel">Edition d'une opportunité</h5>
             <button type="button" class="close" @click="closeModal" style="color: #fff;">
               <span aria-hidden="true" style="color: #fff;">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form id="createForm" @submit.prevent="soumettre">
                <div class="form-group">
                   <label>Titre du poste :</label>
                   <input v-model="editDirection.titre" type="text" class="form-control" 
                   :class="{'is-invalid': editDirection.ErrorTitre != '' }" required/>
                   <span v-if="editDirection.ErrorTitre != '' " class="invalid-feedback error">{{ editDirection.ErrorTitre }}</span>
                </div>
                <div class="form-group">
                   <label>Description :</label>
                   <textarea v-model="editDirection.description" class="form-control" required
                   :class="{'is-invalid': editDirection.ErrorDescription != '' }"></textarea>
                   <span v-if="editDirection.ErrorDescription != '' " class="invalid-feedback error">{{ editDirection.ErrorDescription }}</span>
                </div>
                <div class="form-group">
                   <label>Compétence requise :</label>
                   <textarea v-model="editDirection.competence" class="form-control"
                   :class="{'is-invalid': editDirection.ErrorCompetence != '' }">
                 </textarea>
                   <span v-if="editDirection.ErrorCompetence != '' " class="invalid-feedback error">{{ editDirection.ErrorCompetence }}</span>
                </div>
                <div class="form-group">
                  <label>Date limite :</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                          <input type="date" class="form-control float-right" id="reservation" v-model="editDirection.date" required>
                      </div>
                        <!-- /.input group -->
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
   import { useSwalSuccess, useSwalError } from "../../Composables/alert";
   
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
       titre: "",
       description: "",
       competence: "",
       date: "",
       ErrorTitre: "",
       ErrorDescription: "",
       ErrorCompetence: "",
   
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
       axios.get(route("opportunite.edit", { opportunite: props.directionId }))
       .then((response)=>{
           editDirection.id = response.data.opportunite.id
           editDirection.titre = response.data.opportunite.titre
           editDirection.description = response.data.opportunite.description
           editDirection.competence = response.data.opportunite.competence
           editDirection.date = response.data.opportunite.date
       }).catch((error)=>{
           console.log(error)
       })
    }
    const formateError = ()=>{
         editDirection.ErrorTitre = ""
         editDirection.ErrorCompetence = ""
         editDirection.ErrorDescription = ""
    }
    const soumettre = ()=>{
     Inertia.put(route("opportunite.update", {opportunite: props.directionId}),
     {
       titre: editDirection.titre,
       competence: editDirection.competence,
       description: editDirection.description,
       date: editDirection.date
     },
     {
         onSuccess: (response)=>{
             useSwalSuccess("Opportunite mis á jours effectué")
             formateError()
             closeModal()
         },
         onError: (error)=>{
           if(error.titre != null){
             editDirection.ErrorTitre = error.titre
           }
           if(error.competence != null){
             editDirection.ErrorCompetence = error.competence
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