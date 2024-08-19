<template>
    <div class="detail" style="margin-top: 100px;">
      <section class="content" style="margin-right: -10px;">
        <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
    
          </div>
          <div class="col-md-6">
        
            <div class="card card-primary">
            <div class="card-header" style="background: #2a2185;">
            <h3 class="card-title">Ajouter un Candidat</h3>
            </div>
              <form @submit.prevent="soumettre">
                <div class="card-body">
                <div class="form-group">
                <label for="exampleInputEmail1">numero_inscription :</label>
                <input type="text" class="form-control" id="exampleInputEmail1" v-model="form.numero" :class="{'is-invalid': form.errors.numero}" required>
                <span v-if="form.errors.numero" class="invalid-feedback error">{{ form.errors.numero }}</span>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Numero employer :</label>
                    <select name="exampleInputPassword1" class="form-control" v-model="form.employer_id" required>
                      <option value=""></option>
                      <option :key="Employer.id" v-for="Employer in props.Employers" :value="Employer.id">{{ Employer.numero_employer }}</option>
                    </select>
                    </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Opportunité :</label>
                  <select name="exampleInputPassword1" class="form-control" v-model="form.opportunite_id" required>
                    <option value=""></option>
                    <option :key="Opportunite.id" v-for="Opportunite in props.Opportunites" :value="Opportunite.id">{{ Opportunite.titre }}</option>
                  </select>
                  </div>
                  <div class="form-group">
                    <label for="">Staut :</label>
                    <select @change="recherche" v-model="form.statut" class="form-control">
                        <option value=""></option>
                        <option value="Acceptée">Acceptée</option>
                        <option value="Refusée">Refusée</option>
                        <option value="En_attente">En attente</option>
                        
                    </select>
                </div>
                    <div class="form-group">
                        <label>Date :</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text">
                                  <i class="far fa-calendar-alt"></i>
                                </span>
                              </div>
                                <input type="date" class="form-control float-right" id="reservation" v-model="form.date" required>
                            </div>
                              <!-- /.input group -->
                        </div>
                </div>
                
                <div class="card-footer">
                  <Link :href="route('candidat')" class="btn btn-danger mr-2">Retour</Link>
                <button type="submit" class="btn btn-success">Soumettre</button>
                </div>
                </form>
     
            </div>
          </div>
        <div class="col-md-4">
        
      </div>
    </div>
    </div>
    </section>
    </div>
    
    </template>
    
    <script setup>
       import { useForm } from '@inertiajs/inertia-vue3';
       import { useSwalSuccess, useSwalError } from '../../Composables/alert';
       import { ref } from 'vue';
    
       const props = defineProps({
        Employers: Array,
        Opportunites: Array
       })
       const form = useForm({
        numero: "",
        employer_id: "",
        opportunite_id: "",
        statut: "",
        date: ""
        
       })
       const soumettre = ()=>{
        form.post(route("candidat.store"), {
            onSuccess: (page)=>{
                useSwalSuccess("Candidat ajouté avec success !")
                form.reset()
    
            },
            onError: (errors)=>{
                useSwalError("Une erreur a été produite :(")
    
            }
        })
      }
    </script>
    