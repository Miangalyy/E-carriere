<template>
    <button class="boutton ml-4" data-toggle="modal" data-target="#createNVModal">
        <i class="fa fa-plus"> Ajouter</i>
    </button>
    
 <!-- Modal -->
<div class="modal fade" id="createNVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #2a2185; color: #fff;">
          <h5 class="modal-title" id="exampleModalLabel">Nouveau opportunité</h5>
          <button type="button" class="close" @click="closeModal" style="color: #fff;">
            <span aria-hidden="true" style="color: #fff;">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="soumettre" id="createForm">
             <div class="form-group">
                <label for="nom">Titre du poste :</label>
                <input v-model="title" name="nom" required type="text" class="form-control"/>
             </div>
             <div class="form-group">
                <label for="nom">Description :</label>
                <textarea v-model="desc" name="nom" class="form-control"
                :class="{'is-invalid': descriptionError != '' }"></textarea>
                <span v-if="descriptionError != '' " class="invalid-feedback error">{{ descriptionError }}</span>
             </div>
             <div class="form-group">
                <label for="nom">Compétences requises :</label>
                <textarea v-model="comp" name="nom" class="form-control"
                :class="{'is-invalid': compError != '' }"></textarea>
                <span v-if="compError != '' " class="invalid-feedback error">{{ compError }}</span>
             </div>
             <div class="form-group">
                <label>Date :</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                        <input type="date" class="form-control float-right" id="reservation" v-model="daty" required>
                    </div>
                      <!-- /.input group -->
                </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" @click="closeModal">Fermer</button>
          <button form="createForm" type="submit" class="btn btn-success">Soumettre</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
 import { ref, onMounted } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { useSwalSuccess, useSwalError } from "../../Composables/alert.js"


const daty = ref("");
const title = ref("");
const desc = ref("");
const comp = ref("");
const compError = ref("");
const descriptionError = ref("");
const descError = ref("");
let createModal = ""
onMounted(() => {
  createModal =  $("#createNVModal")
})
const closeModal = ()=>{
    createModal.modal("hide")
    
  }
  const soumettre = ()=>{
    const titre = title.value
    const description = desc.value
    const competence = comp.value
    const date = daty.value
    const url = route("opportunite.create")
    Inertia.post(url, {titre, description, competence, date}, {
      onSuccess: (page) => {
        closeModal()

        //Message de success
        useSwalSuccess("Opportunité ajouté avec success !")

      },
      onError: (Errors) => {
        if(Errors.competence != null){
           compError.value = Errors.competence
          useSwalError("Une erreur s'est produite :(")
        }
        if(Errors.description != null){
          descriptionError.value = Errors.description
          useSwalError("Une erreur s'est produite :(")
        }
        

      }
    })

  }
</script>