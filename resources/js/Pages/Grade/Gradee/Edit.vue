<template>
    
    <!-- Modal -->
   <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background: #2a2185; color: #fff;">
             <h5 class="modal-title" id="exampleModalLabel">Édition d'un grade</h5>
             <button type="button" class="close" @click="closeModal">
               <span aria-hidden="true" style="background: #2a2185; color: #fff;">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form id="createForm" @submit.prevent="soumettre">
                <div class="form-group">
                   <label>Numero_direction :</label>
                   <input v-model="editDirection.numero_grade" type="text" class="form-control" 
                   :class="{'is-invalid': editDirection.ErrorNumero_grade != '' }" required/>
                   <span v-if="editDirection.ErrorNumero_grade != '' " class="invalid-feedback error">{{ editDirection.ErrorNumero_grade }}</span>
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
       numero_grade: "",
       titre: "",
       description: "",
       ErrorNumero_grade: "",
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
       axios.get(route("grade.edit", { grade: props.directionId }))
       .then((response)=>{
           editDirection.id = response.data.grade.id
           editDirection.numero_grade = response.data.grade.numero_grade
           editDirection.titre = response.data.grade.titre
           editDirection.description = response.data.grade.description
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
     Inertia.put(route("grade.update", {grade: props.directionId}),
     {
       numero_grade: editDirection.numero_grade,
       titre: editDirection.titre,
       description: editDirection.description,
     },
     {
         onSuccess: (response)=>{
             useSwalSuccess("Grade mis á jours effectué")
             formateError()
             closeModal()
         },
         onError: (error)=>{
           if(error.numero_grade != null){
             editDirection.ErrorNumero_grade = error.numero_grade
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