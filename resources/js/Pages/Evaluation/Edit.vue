<template>
    
    <!-- Modal -->
   <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header" style="background: #2a2185; color: #fff;">
             <h5 class="modal-title" id="exampleModalLabel">Edition d'une evaluation</h5>
             <button type="button" class="close" @click="closeModal" style="color: #fff;">
               <span aria-hidden="true" style="color: #fff;">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form id="createForm" @submit.prevent="soumettre">
                <div class="form-group">
                   <label>Titre de l'evaluation :</label>
                   <input v-model="editDirection.titre" type="text" class="form-control" 
                   :class="{'is-invalid': editDirection.ErrorTitre != '' }" required/>
                   <span v-if="editDirection.ErrorTitre != '' " class="invalid-feedback error">{{ editDirection.ErrorTitre }}</span>
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
       axios.get(route("evaluation.edit", { evaluation: props.directionId }))
       .then((response)=>{
           editDirection.id = response.data.evaluation.id
           editDirection.titre = response.data.evaluation.titre
       }).catch((error)=>{
           console.log(error)
       })
    }
    const formateError = ()=>{
         editDirection.ErrorTitre = ""
    }
    const soumettre = ()=>{
     Inertia.put(route("evaluation.update", {evaluation: props.directionId}),
     {
       titre: editDirection.titre,
     },
     {
         onSuccess: (response)=>{
             useSwalSuccess("Evaluation mis á jours effectué")
             formateError()
             closeModal()
         },
         onError: (error)=>{
           if(error.titre != null){
             editDirection.ErrorTitre = error.titre
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