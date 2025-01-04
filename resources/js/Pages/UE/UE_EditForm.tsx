import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import MyInput from '@/Components/MyInput';
import MyLabel from '@/Components/MyLabel';
import { useForm } from '@inertiajs/react';
import InputError from '@/Components/InputError';

interface UE {
    id: number;
    code: string,
    nom: string,
    credits_ects: number,
    semestre: number
}

interface Prop {
    ue: UE
}

export default function UE({ue}: Prop) {

    const semestres = [1, 2, 3, 4, 5, 6]
    console.log(ue);
    const { data, setData, patch, processing, reset, errors } = useForm({
        code: ue.code,
        nom: ue.nom,
        credits_ects: ue.credits_ects,
        semestre: ue.semestre
    });

    function handleSubmit(e : React.FormEvent<HTMLFormElement>) {
        e.preventDefault();
        patch(route('UE.update', ue.id), { onSuccess: () => reset() });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    UE
                </h2>
            }
        >
            <Head title="UE_Form" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-5">
                        <form  onSubmit={handleSubmit}>
                            <MyInput
                                type='text'
                                name='code'
                                id='codeID'
                                labelValue='CODE: '
                                inputValue={data.code}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('code', e.target.value)}
                            />
                            <InputError message={errors.code} className="mt-2" />
                            <MyInput
                                type='text'
                                name='nom'
                                id='nomID'
                                labelValue='NOM: '
                                inputValue={data.nom}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('nom', e.target.value)}
                            />
                            <InputError message={errors.nom} className="mt-2" />
                            <MyInput
                                type='number'
                                name='credits_ects'
                                id='credits_ects_ID'
                                labelValue="CREDIT: "
                                inputValue={data.credits_ects}
                                onChangeValue={(e : React.ChangeEvent<HTMLInputElement>) => setData('credits_ects', Number(e.target.value))}
                            />
                            <InputError message={errors.credits_ects} className="mt-2" />
                            <MyLabel labelFor="semestreID">SEMESTRE: </MyLabel>
                            <select name="semestre" id="semestreID" onChange={e => setData('semestre', Number(e.target.value))}>
                                {semestres.map(semestre => {
                                    return <option key={semestre} value={semestre}>{semestre}</option>
                                })}
                            </select>

                            <div className='my-4'>
                                <button disabled={processing} className='rounded-xl p-2 border-2'>Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
